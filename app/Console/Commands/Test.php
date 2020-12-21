<?php

namespace App\Console\Commands;

use App\Models\Product\Product;
use App\Models\Product\ProductBrand;
use App\Models\Product\ProductCategory;
use GuzzleHttp\Client;
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
        $res = Http::withOptions([
            'timeout' => 600
        ])->get($url,[
            'categoryId' => 1011000,
            '__timestamp' => intval(time().'000')
        ]);
        $data = $res->json();
        foreach ($data['data']['categoryGroupList'] as $v) {
//            if (ProductCategory::query()->where('category_name',$v['name'])->exists()) {
//              continue;
//            }
//            $pcreate = ProductCategory::query()->create([
//                'parent_id' => 203,
//                'category_name' => $v['name'],
//                'on_sale' => 1,
//                'sort' => 0
//            ]);
            foreach ($v['categoryList'] as $vv) {
//                $str = 'product/brand/'.Str::random(40).'.png';
//                Storage::disk('oss')->put($str,file_get_contents($vv['wapBannerUrl']));
//                $path = Storage::disk('oss')->url($str);
//                $create = ProductCategory::query()->create([
//                    'parent_id' => $pcreate->id,
//                    'category_name' => $vv['name'],
//                    'category_image' => $path,
//                    'on_sale' => 1,
//                    'sort' => 0
//                ]);
                $this->goods($vv['superCategoryId'], $vv['id'],$vv['name']);
            }
        }
    }

    public function goods($categoryId, $subCategoryId,$name) {
        $url = 'http://m.you.163.com/item/list.json';

        $res = Http::withOptions([
            'timeout' => 600
        ])->get($url,[
            'categoryId' => $categoryId,
            'categoryType' => 0,
            'subCategoryId' => $subCategoryId,
            '__timestamp' => intval(time().'000')
        ]);
        // 获取分类
        $cateId = ProductCategory::query()->where('category_name',$name)->value('id');
        $data = $res->json();
        foreach ($data['data']['categoryItems']['itemList'] as $v) {
            if (Product::query()->where('product_name', $v['name'])->exists()) {
                continue;
            }
            $url2 = 'http://m.you.163.com/item/detail?id='.$v['id'];
            $detail = Http::withOptions([
                'timeout' => 600
            ])->withHeaders([
                'Accept' => 'application/json'
            ])->get($url2);
            $detail = $detail->json();
            $str = 'product/'.Str::random(40).'.png';
            Storage::disk('oss')->put($str,file_get_contents($v['listPicUrl']));
            $imagePath = Storage::disk('oss')->url($str);
            $goods = new Product();
            $goods->category_id = $cateId;
            $goods->product_name = $v['name'];
            $goods->product_banner = [
                $this->getImage($detail['item']['itemDetail']['picUrl1']),
                $this->getImage($detail['item']['itemDetail']['picUrl2']),
                $this->getImage($detail['item']['itemDetail']['picUrl3']),
            ];
            $goods->selling_point  = $v['simpleDesc'];
            $goods->product_image = $imagePath;
            $goods->price = $v['retailPrice'];
            $goods->market_price = $v['counterPrice'] ?? 0;
            $goods->on_sale = 1;
            $goods->stock = 0;
            $goods->content =$detail['item']['itemDetail']['detailHtml'];
            $goods->save();

            $attrData = [];
            foreach ($detail['item']['attrList'] as $p) {
                $attrData[] = [
                    'name' => $p['attrName'],
                    'product_id' => $goods->id,
                    'value' => $p['attrValue'],
                    'created_at' => now()->toDateTimeString(),
                    'updated_at' => now()->toDateTimeString(),
                ];
            }
            $goods->properties()->insert($attrData);
        }
    }

    private function getImage($url) {
        $str = 'product/'.Str::random(40).'.png';
        Storage::disk('oss')->put($str,file_get_contents($url));
        return Storage::disk('oss')->url($str);
    }
}
