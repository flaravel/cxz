<?php

/**
 * A helper file for Dcat Admin, to provide autocomplete information to your IDE
 *
 * This file should not be included in your code, only analyzed by your IDE!
 *
 * @author jqh <841324345@qq.com>
 */
namespace Dcat\Admin {
    use Illuminate\Support\Collection;

    /**
     * @property Grid\Column|Collection created_at
     * @property Grid\Column|Collection detail
     * @property Grid\Column|Collection id
     * @property Grid\Column|Collection name
     * @property Grid\Column|Collection type
     * @property Grid\Column|Collection updated_at
     * @property Grid\Column|Collection version
     * @property Grid\Column|Collection is_enabled
     * @property Grid\Column|Collection extension
     * @property Grid\Column|Collection icon
     * @property Grid\Column|Collection order
     * @property Grid\Column|Collection parent_id
     * @property Grid\Column|Collection show
     * @property Grid\Column|Collection uri
     * @property Grid\Column|Collection menu_id
     * @property Grid\Column|Collection permission_id
     * @property Grid\Column|Collection http_method
     * @property Grid\Column|Collection http_path
     * @property Grid\Column|Collection slug
     * @property Grid\Column|Collection role_id
     * @property Grid\Column|Collection user_id
     * @property Grid\Column|Collection value
     * @property Grid\Column|Collection avatar
     * @property Grid\Column|Collection password
     * @property Grid\Column|Collection remember_token
     * @property Grid\Column|Collection username
     * @property Grid\Column|Collection connection
     * @property Grid\Column|Collection exception
     * @property Grid\Column|Collection failed_at
     * @property Grid\Column|Collection payload
     * @property Grid\Column|Collection queue
     * @property Grid\Column|Collection uuid
     * @property Grid\Column|Collection client_id
     * @property Grid\Column|Collection expires_at
     * @property Grid\Column|Collection revoked
     * @property Grid\Column|Collection scopes
     * @property Grid\Column|Collection password_client
     * @property Grid\Column|Collection personal_access_client
     * @property Grid\Column|Collection provider
     * @property Grid\Column|Collection redirect
     * @property Grid\Column|Collection secret
     * @property Grid\Column|Collection access_token_id
     * @property Grid\Column|Collection brand_name
     * @property Grid\Column|Collection deleted_at
     * @property Grid\Column|Collection desc
     * @property Grid\Column|Collection logo_url
     * @property Grid\Column|Collection on_sale
     * @property Grid\Column|Collection category_image
     * @property Grid\Column|Collection category_name
     * @property Grid\Column|Collection path
     * @property Grid\Column|Collection sort
     * @property Grid\Column|Collection product_id
     * @property Grid\Column|Collection brand_id
     * @property Grid\Column|Collection category_id
     * @property Grid\Column|Collection content
     * @property Grid\Column|Collection delivery_id
     * @property Grid\Column|Collection is_new
     * @property Grid\Column|Collection is_recommend
     * @property Grid\Column|Collection market_price
     * @property Grid\Column|Collection price
     * @property Grid\Column|Collection product_banner
     * @property Grid\Column|Collection product_image
     * @property Grid\Column|Collection product_name
     * @property Grid\Column|Collection sales_actual
     * @property Grid\Column|Collection sales_initial
     * @property Grid\Column|Collection selling_point
     * @property Grid\Column|Collection stock
     * @property Grid\Column|Collection batch_id
     * @property Grid\Column|Collection family_hash
     * @property Grid\Column|Collection sequence
     * @property Grid\Column|Collection should_display_on_index
     * @property Grid\Column|Collection entry_uuid
     * @property Grid\Column|Collection tag
     *
     * @method Grid\Column|Collection created_at(string $label = null)
     * @method Grid\Column|Collection detail(string $label = null)
     * @method Grid\Column|Collection id(string $label = null)
     * @method Grid\Column|Collection name(string $label = null)
     * @method Grid\Column|Collection type(string $label = null)
     * @method Grid\Column|Collection updated_at(string $label = null)
     * @method Grid\Column|Collection version(string $label = null)
     * @method Grid\Column|Collection is_enabled(string $label = null)
     * @method Grid\Column|Collection extension(string $label = null)
     * @method Grid\Column|Collection icon(string $label = null)
     * @method Grid\Column|Collection order(string $label = null)
     * @method Grid\Column|Collection parent_id(string $label = null)
     * @method Grid\Column|Collection show(string $label = null)
     * @method Grid\Column|Collection uri(string $label = null)
     * @method Grid\Column|Collection menu_id(string $label = null)
     * @method Grid\Column|Collection permission_id(string $label = null)
     * @method Grid\Column|Collection http_method(string $label = null)
     * @method Grid\Column|Collection http_path(string $label = null)
     * @method Grid\Column|Collection slug(string $label = null)
     * @method Grid\Column|Collection role_id(string $label = null)
     * @method Grid\Column|Collection user_id(string $label = null)
     * @method Grid\Column|Collection value(string $label = null)
     * @method Grid\Column|Collection avatar(string $label = null)
     * @method Grid\Column|Collection password(string $label = null)
     * @method Grid\Column|Collection remember_token(string $label = null)
     * @method Grid\Column|Collection username(string $label = null)
     * @method Grid\Column|Collection connection(string $label = null)
     * @method Grid\Column|Collection exception(string $label = null)
     * @method Grid\Column|Collection failed_at(string $label = null)
     * @method Grid\Column|Collection payload(string $label = null)
     * @method Grid\Column|Collection queue(string $label = null)
     * @method Grid\Column|Collection uuid(string $label = null)
     * @method Grid\Column|Collection client_id(string $label = null)
     * @method Grid\Column|Collection expires_at(string $label = null)
     * @method Grid\Column|Collection revoked(string $label = null)
     * @method Grid\Column|Collection scopes(string $label = null)
     * @method Grid\Column|Collection password_client(string $label = null)
     * @method Grid\Column|Collection personal_access_client(string $label = null)
     * @method Grid\Column|Collection provider(string $label = null)
     * @method Grid\Column|Collection redirect(string $label = null)
     * @method Grid\Column|Collection secret(string $label = null)
     * @method Grid\Column|Collection access_token_id(string $label = null)
     * @method Grid\Column|Collection brand_name(string $label = null)
     * @method Grid\Column|Collection deleted_at(string $label = null)
     * @method Grid\Column|Collection desc(string $label = null)
     * @method Grid\Column|Collection logo_url(string $label = null)
     * @method Grid\Column|Collection on_sale(string $label = null)
     * @method Grid\Column|Collection category_image(string $label = null)
     * @method Grid\Column|Collection category_name(string $label = null)
     * @method Grid\Column|Collection path(string $label = null)
     * @method Grid\Column|Collection sort(string $label = null)
     * @method Grid\Column|Collection product_id(string $label = null)
     * @method Grid\Column|Collection brand_id(string $label = null)
     * @method Grid\Column|Collection category_id(string $label = null)
     * @method Grid\Column|Collection content(string $label = null)
     * @method Grid\Column|Collection delivery_id(string $label = null)
     * @method Grid\Column|Collection is_new(string $label = null)
     * @method Grid\Column|Collection is_recommend(string $label = null)
     * @method Grid\Column|Collection market_price(string $label = null)
     * @method Grid\Column|Collection price(string $label = null)
     * @method Grid\Column|Collection product_banner(string $label = null)
     * @method Grid\Column|Collection product_image(string $label = null)
     * @method Grid\Column|Collection product_name(string $label = null)
     * @method Grid\Column|Collection sales_actual(string $label = null)
     * @method Grid\Column|Collection sales_initial(string $label = null)
     * @method Grid\Column|Collection selling_point(string $label = null)
     * @method Grid\Column|Collection stock(string $label = null)
     * @method Grid\Column|Collection batch_id(string $label = null)
     * @method Grid\Column|Collection family_hash(string $label = null)
     * @method Grid\Column|Collection sequence(string $label = null)
     * @method Grid\Column|Collection should_display_on_index(string $label = null)
     * @method Grid\Column|Collection entry_uuid(string $label = null)
     * @method Grid\Column|Collection tag(string $label = null)
     */
    class Grid {}

    class MiniGrid extends Grid {}

    /**
     * @property Show\Field|Collection created_at
     * @property Show\Field|Collection detail
     * @property Show\Field|Collection id
     * @property Show\Field|Collection name
     * @property Show\Field|Collection type
     * @property Show\Field|Collection updated_at
     * @property Show\Field|Collection version
     * @property Show\Field|Collection is_enabled
     * @property Show\Field|Collection extension
     * @property Show\Field|Collection icon
     * @property Show\Field|Collection order
     * @property Show\Field|Collection parent_id
     * @property Show\Field|Collection show
     * @property Show\Field|Collection uri
     * @property Show\Field|Collection menu_id
     * @property Show\Field|Collection permission_id
     * @property Show\Field|Collection http_method
     * @property Show\Field|Collection http_path
     * @property Show\Field|Collection slug
     * @property Show\Field|Collection role_id
     * @property Show\Field|Collection user_id
     * @property Show\Field|Collection value
     * @property Show\Field|Collection avatar
     * @property Show\Field|Collection password
     * @property Show\Field|Collection remember_token
     * @property Show\Field|Collection username
     * @property Show\Field|Collection connection
     * @property Show\Field|Collection exception
     * @property Show\Field|Collection failed_at
     * @property Show\Field|Collection payload
     * @property Show\Field|Collection queue
     * @property Show\Field|Collection uuid
     * @property Show\Field|Collection client_id
     * @property Show\Field|Collection expires_at
     * @property Show\Field|Collection revoked
     * @property Show\Field|Collection scopes
     * @property Show\Field|Collection password_client
     * @property Show\Field|Collection personal_access_client
     * @property Show\Field|Collection provider
     * @property Show\Field|Collection redirect
     * @property Show\Field|Collection secret
     * @property Show\Field|Collection access_token_id
     * @property Show\Field|Collection brand_name
     * @property Show\Field|Collection deleted_at
     * @property Show\Field|Collection desc
     * @property Show\Field|Collection logo_url
     * @property Show\Field|Collection on_sale
     * @property Show\Field|Collection category_image
     * @property Show\Field|Collection category_name
     * @property Show\Field|Collection path
     * @property Show\Field|Collection sort
     * @property Show\Field|Collection product_id
     * @property Show\Field|Collection brand_id
     * @property Show\Field|Collection category_id
     * @property Show\Field|Collection content
     * @property Show\Field|Collection delivery_id
     * @property Show\Field|Collection is_new
     * @property Show\Field|Collection is_recommend
     * @property Show\Field|Collection market_price
     * @property Show\Field|Collection price
     * @property Show\Field|Collection product_banner
     * @property Show\Field|Collection product_image
     * @property Show\Field|Collection product_name
     * @property Show\Field|Collection sales_actual
     * @property Show\Field|Collection sales_initial
     * @property Show\Field|Collection selling_point
     * @property Show\Field|Collection stock
     * @property Show\Field|Collection batch_id
     * @property Show\Field|Collection family_hash
     * @property Show\Field|Collection sequence
     * @property Show\Field|Collection should_display_on_index
     * @property Show\Field|Collection entry_uuid
     * @property Show\Field|Collection tag
     *
     * @method Show\Field|Collection created_at(string $label = null)
     * @method Show\Field|Collection detail(string $label = null)
     * @method Show\Field|Collection id(string $label = null)
     * @method Show\Field|Collection name(string $label = null)
     * @method Show\Field|Collection type(string $label = null)
     * @method Show\Field|Collection updated_at(string $label = null)
     * @method Show\Field|Collection version(string $label = null)
     * @method Show\Field|Collection is_enabled(string $label = null)
     * @method Show\Field|Collection extension(string $label = null)
     * @method Show\Field|Collection icon(string $label = null)
     * @method Show\Field|Collection order(string $label = null)
     * @method Show\Field|Collection parent_id(string $label = null)
     * @method Show\Field|Collection show(string $label = null)
     * @method Show\Field|Collection uri(string $label = null)
     * @method Show\Field|Collection menu_id(string $label = null)
     * @method Show\Field|Collection permission_id(string $label = null)
     * @method Show\Field|Collection http_method(string $label = null)
     * @method Show\Field|Collection http_path(string $label = null)
     * @method Show\Field|Collection slug(string $label = null)
     * @method Show\Field|Collection role_id(string $label = null)
     * @method Show\Field|Collection user_id(string $label = null)
     * @method Show\Field|Collection value(string $label = null)
     * @method Show\Field|Collection avatar(string $label = null)
     * @method Show\Field|Collection password(string $label = null)
     * @method Show\Field|Collection remember_token(string $label = null)
     * @method Show\Field|Collection username(string $label = null)
     * @method Show\Field|Collection connection(string $label = null)
     * @method Show\Field|Collection exception(string $label = null)
     * @method Show\Field|Collection failed_at(string $label = null)
     * @method Show\Field|Collection payload(string $label = null)
     * @method Show\Field|Collection queue(string $label = null)
     * @method Show\Field|Collection uuid(string $label = null)
     * @method Show\Field|Collection client_id(string $label = null)
     * @method Show\Field|Collection expires_at(string $label = null)
     * @method Show\Field|Collection revoked(string $label = null)
     * @method Show\Field|Collection scopes(string $label = null)
     * @method Show\Field|Collection password_client(string $label = null)
     * @method Show\Field|Collection personal_access_client(string $label = null)
     * @method Show\Field|Collection provider(string $label = null)
     * @method Show\Field|Collection redirect(string $label = null)
     * @method Show\Field|Collection secret(string $label = null)
     * @method Show\Field|Collection access_token_id(string $label = null)
     * @method Show\Field|Collection brand_name(string $label = null)
     * @method Show\Field|Collection deleted_at(string $label = null)
     * @method Show\Field|Collection desc(string $label = null)
     * @method Show\Field|Collection logo_url(string $label = null)
     * @method Show\Field|Collection on_sale(string $label = null)
     * @method Show\Field|Collection category_image(string $label = null)
     * @method Show\Field|Collection category_name(string $label = null)
     * @method Show\Field|Collection path(string $label = null)
     * @method Show\Field|Collection sort(string $label = null)
     * @method Show\Field|Collection product_id(string $label = null)
     * @method Show\Field|Collection brand_id(string $label = null)
     * @method Show\Field|Collection category_id(string $label = null)
     * @method Show\Field|Collection content(string $label = null)
     * @method Show\Field|Collection delivery_id(string $label = null)
     * @method Show\Field|Collection is_new(string $label = null)
     * @method Show\Field|Collection is_recommend(string $label = null)
     * @method Show\Field|Collection market_price(string $label = null)
     * @method Show\Field|Collection price(string $label = null)
     * @method Show\Field|Collection product_banner(string $label = null)
     * @method Show\Field|Collection product_image(string $label = null)
     * @method Show\Field|Collection product_name(string $label = null)
     * @method Show\Field|Collection sales_actual(string $label = null)
     * @method Show\Field|Collection sales_initial(string $label = null)
     * @method Show\Field|Collection selling_point(string $label = null)
     * @method Show\Field|Collection stock(string $label = null)
     * @method Show\Field|Collection batch_id(string $label = null)
     * @method Show\Field|Collection family_hash(string $label = null)
     * @method Show\Field|Collection sequence(string $label = null)
     * @method Show\Field|Collection should_display_on_index(string $label = null)
     * @method Show\Field|Collection entry_uuid(string $label = null)
     * @method Show\Field|Collection tag(string $label = null)
     */
    class Show {}

    /**
     * @method \App\Admin\Extensions\Sku sku(...$params)
     * @method \App\Admin\Extensions\Ueditor ueditor(...$params)
     */
    class Form {}

}

namespace Dcat\Admin\Grid {
    /**
     
     */
    class Column {}

    /**
     
     */
    class Filter {}
}

namespace Dcat\Admin\Show {
    /**
     
     */
    class Field {}
}
