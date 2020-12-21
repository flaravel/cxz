<?php

namespace App\Console\Commands;

use App\Models\Product\ProductBrand;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test {method?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $method = $this->argument('method');

        if (method_exists(self::class,$method)) {
            $this->{$method}();
            return;
        }
        $this->error('not found method');
    }

    public function cates() {
        $url = 'https://m.you.163.com/item/cateList.json';

        $res = Http::get($url);

        $data = $res->json();

        $newData = [];
        foreach ($data['data'] as $v) {
            foreach ($v['categoryList'] as $brand) {
                $str = 'product/brand/'.Str::random(40).'.png';
                Storage::disk('oss')->put($str,file_get_contents($brand['categoryLogo']));
                $path = Storage::disk('oss')->url($str);
                $newData[] = [
                    'brand_name' => $brand['categoryName'],
                    'logo_url' => $path,
                    'on_sale' => 1,
                    'created_at' => now()->toDateTimeString(),
                    'updated_at' => now()->toDateTimeString(),
                ];
                $create = ProductBrand::query()->create([
                    'brand_name' => $brand['categoryName'],
                    'logo_url' => $path,
                    'created_at' => now()->toDateTimeString(),
                    'updated_at' => now()->toDateTimeString(),
                ]);
                dd($create);
            }
        }
        ProductBrand::query()->insert($newData);
    }

    public function cate() {
        $url = 'https://tea.chazhenxuan.com/v1/category/classify/list';

        $res = Http::post($url);

        $data = $res->json();

        foreach ($data['data'] as $v) {
            if ($v['categoryName'] != '品牌') {
                foreach ($v['categoryList'] as $vv) {
                    $url2 = 'https://tea.chazhenxuan.com/v1/product/list/app';
                    $res2 = Http::send('post',$url2,[
                        'form_params' => [
                            'pageNum' => 1,
                            'categoryId' => $vv['nodeCategoryId']
                        ]
                    ]);
                    $data2 = $res2->json();
                    foreach ($data2['data']['productList'] as $vvv) {
                        $url3 = 'https://tea.chazhenxuan.com/v1/product/app/detail';
                        $res3 = Http::send('post',$url3,[
                            'form_params' => [
                                'productId' => $vvv['productId'],
                                'specialId' => '',
                                'userId' => '',
                            ]
                        ]);
                        $cateId = GoodsCategory::query()->where('category_name',$vv['categoryName'])->value('id');
                        $data3 = $res3->json();
                        if (isset($data3['data'])) {
                            $goods = new Goods();
                            $goods->supplier_id = 1;
                            $goods->cate_id = $cateId;
                            $goods->name = $data3['data']['teaProduct']['productName'];
                            $goods->thumb = $data3['data']['teaProduct']['productImage'];
                            $goods->price = $data3['data']['teaAttrProduct'][0]['productPrice'];
                            $goods->original_price = $data3['data']['teaAttrProduct'][0]['virtualPrice'];
                            $goods->cost_price = 10;
                            $goods->on_sale = 1;
                            $goods->stock = 999;
                            $goods->content = $this->getContent($data3['data']['teaProductBannerBottom']);

                            $goods->save();

                            foreach ($data3['data']['teaProductBannerTop'] as $key => $img) {
                                if ($key == 5) {
                                    continue;
                                }
                                GoodsImage::query()->create([
                                    'image' => $img['productImage'],
                                    'goods_id' => $goods->id
                                ]);
                            }
                        }
                    }
                }
            }
        }
    }

    protected function getContent($data) {
        $str = '';
        foreach ($data as $v) {
            $str .= "<p><img src='{$v['productImage']}' alt=''></p>";
        }
        return $str;
    }
}
