<?php

// 所有上下架状态
const UP_SALE = 1;
const DOWN_SALE = 0;
const SALE_MAP = [
    UP_SALE => '已上架',
    DOWN_SALE => '已下架',
];

// 商品新品常量
const PRODUCT_NEW = 1;
const PRODUCT_NOT_NEW = 0;
const PRODUCT_NEW_MAP = [
    PRODUCT_NEW => '新品',
];

// 商品推荐常量
const PRODUCT_RECOMMEND = 1;
const PRODUCT_NOT_RECOMMEND = 0;
const PRODUCT_RECOMMEND_MAP = [
    PRODUCT_RECOMMEND => '推荐',
];
