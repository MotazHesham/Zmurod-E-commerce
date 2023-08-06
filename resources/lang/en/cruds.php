<?php

return [
    'userManagement' => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission' => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'country'                 => 'Country',
            'password_helper'          => ' ',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'user_type'                => 'User Type',
            'user_type_helper'         => ' ',
        ],
    ],
    'product' => [
        'title'          => 'Products',
        'title_singular' => 'Product',
        'fields'         => [
            'id'                      => 'ID',
            'id_helper'               => ' ',
            'name'                    => 'name',
            'name_helper'             => ' ',
            'created_at'              => 'Created at',
            'created_at_helper'       => ' ',
            'updated_at'              => 'Updated at',
            'updated_at_helper'       => ' ',
            'deleted_at'              => 'Deleted at',
            'deleted_at_helper'       => ' ',
            'current_stock'           => 'Stock_quantity',
            'current_stock_helper'    => ' ',
            'information'             => 'Details',
            'information_helper'      => ' ',
            'most_recent'             => 'Recently',
            'most_recent_helper'      => ' ',
            'discount'                => 'Discount',
            'discount_helper'         => ' ',
            'price'                   => 'Price',
            'price_helper'            => ' ',
            'image'                   => 'Image',
            'image_helper'            => '800x800',
            'product_tags'            => 'Tags',
            'product_tags_helper'     => ' ',
            'product_category'        => 'Category',
            'product_category_helper' => ' ',
            'user'                    => 'User',
            'user_helper'             => ' ',
            'fav'                     => 'FAV',
            'fav_helper'              => ' ',
            'published' => 'Published',
            'published_helper' => ' ',
            'product_offers'          => 'Offers',
            'product_offers_helper'   => ' ',
            'shipping_method'         => 'Shipping Method',
            'shipping_method_helper'  => ' ',
        ],
    ],
    'course' => [
        'title'          => 'Courses',
        'title_singular' => 'Course',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => ' Coures',
            'name_helper'        => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'trainer'            => 'Trainer',
            'trainer_helper'     => ' ',
            'start_at'           => 'Start_at ',
            'start_at_helper'    => ' ',
            'photo'              => 'Photo',
            'photo_helper'       => ' ',
            'price'              => 'Price',
            'courses_hours'      => 'Course Hours',
            'courses_hours_helper' => '',
            'price_helper'       => '',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'tradersForum' => [
        'title'          => 'Traders Forum',
        'title_singular' => 'Traders Forum',
    ],
    'froum' => [
        'title'          => 'Forums',
        'title_singular' => 'Forum',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Name',
            'name_helper'        => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'category'           => 'Category',
            'category_helper'    => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'post' => [
        'title'          => 'Posts',
        'title_singular' => 'Post',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'title'                => 'Title',
            'title_helper'         => ' ',
            'content'              => 'Content',
            'content_helper'       => ' ',
            'post_forum'           => 'Forum Type',
            'post_forum_helper'    => ' ',
            'author'               => 'Author',
            'author_helper'        => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
            'post_comments'        => 'Post Comments',
            'post_comments_helper' => ' ',
            'photos'               => 'Photos',
            'photos_helper'        => ' ',
            'post_tags'            => 'Tags',
            'post_tags_helper'     => ' ',
        ],
    ],
    'comment' => [
        'title'          => 'Comments',
        'title_singular' => 'Comment',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'comment'             => 'Comment',
            'comment_helper'      => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
            'user_comment'        => 'User Comment',
            'user_comment_helper' => ' ',
            'comment_for'         => 'Comment For',
            'comment_for_helper'  => ' ',
        ],
    ],
    'blogsManagment' => [
        'title'          => 'Blogs Managment',
        'title_singular' => 'Blogs Managment',
    ],
    'blog' => [
        'title'          => 'Blogs',
        'title_singular' => 'Blog',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'title'                    => 'Title',
            'title_helper'             => ' ',
            'content'                  => 'Content',
            'content_helper'           => ' ',
            'video'                    => 'Video',
            'video_helper'             => ' ',
            'photo'                    => 'Photo',
            'photo_helper'             => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'short_description'        => 'Short Description',
            'short_description_helper' => ' ',
            'user'                     => 'User',
            'user_helper'              => ' ',
            'media_url'                => 'Media Url',
            'media_url_helper'         => ' ',
            'type'                     => 'Type',
            'type_helper'              => ' ',
        ],
    ],
    'customerService' => [
        'title'          => 'Customer Service',
        'title_singular' => 'Customer Service',
    ],
    'message' => [
        'title'          => 'Messages',
        'title_singular' => 'Message',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'email'             => 'E-Mail',
            'email_helper'      => ' ',
            'subject'           => 'Subject',
            'subject_helper'    => ' ',
            'message'           => 'Message',
            'message_helper'    => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'generalSetting' => [
        'title'          => 'General Settings',
        'title_singular' => 'General Setting',
    ],
    'slider' => [
        'title'          => 'Slider',
        'title_singular' => 'Slider',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'photo'              => 'Photo',
            'photo_helper'       => '966X495',
            'status'             => 'Status',
            'status_helper'      => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'banner' => [
        'title'          => 'Banner',
        'title_singular' => 'Banner',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'title'               => 'Title',
            'title_helper'        => ' ',
            'banner_photo'        => 'Banner Photo',
            'banner_photo_helper' =>  ' 570  x 320 only ',
            'active'              => 'Active',
            'active_helper'       => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
        ],
    ],
    'productManagment' => [
        'title'          => 'Product Managment',
        'title_singular' => 'Product Managment',
    ],
    'category' => [
        'title'          => 'Categories',
        'title_singular' => 'Category',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Name',
            'name_helper'        => ' ',
            'icon'               => 'Icon',
            'icon_helper'        => ' ',
            'most_recent'        => 'Most Recent',
            'most_recent_helper' => ' ',
            'fav'                => 'Fav',
            'fav_helper'         => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'seller' => [
        'title'          => 'Sellers',
        'title_singular' => 'Seller',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'photo'                 => 'Photo',
            'photo_helper'          => ' ',
            'name'                  => 'Seller Name',
            'name_helper'           => '',
            'email'                 => 'Seller Email',
            'email_helper'          => '',
            'country'               => 'Country ',
            'country_helper'        => '',
            'phone'                 => 'phone ',
            'phone_helper'          => '',
            'store_name'            => 'Store Name',
            'store_name_helper'     => ' ',
            'description'           => 'Description',
            'description_helper'    => ' ',
            'user'                  => 'User',
            'user_helper'           => ' ',
            'address'                  => 'Address',
            'address_helper'           => ' ',
            'featured_store'        => 'Featured Store',
            'featured_store_helper' => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',

        ],
    ],
    'tag' => [
        'title'          => 'Tags',
        'title_singular' => 'Tag',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'review' => [
        'title'          => 'Reviews',
        'title_singular' => 'Review',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'rating'                => 'Rating',
            'rating_helper'         => ' ',
            'comment'               => 'Comment',
            'comment_helper'        => ' ',
            'published'             => 'Published',
            'published_helper'      => ' ',
            'user_review'           => 'User Review',
            'user_review_helper'    => ' ',
            'product_review'        => 'Product Review',
            'product_review_helper' => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',
        ],
    ],
    'aboutUs' => [
        'title'          => 'About Us',
        'title_singular' => 'About Us',
        'fields'         => [
            'id'                          => 'ID',
            'id_helper'                   => ' ',
            'vision'                      => 'Vision',
            'vision_helper'               => ' ',
            'email'                       => ' E-Mail',
            'email_helper'                => ' ',
            'phone_number'                => ' Phone 1',
            'phone_number_helper'         => ' ',
            'phone_number_2'              => 'Phone  2',
            'phone_number_2_helper'       => ' ',
            'logo'                        => 'Logo',
            'logo_helper'                 => ' ',
            'created_at'                  => 'Created at',
            'created_at_helper'           => ' ',
            'updated_at'                  => 'Updated at',
            'updated_at_helper'           => ' ',
            'deleted_at'                  => 'Deleted at',
            'deleted_at_helper'           => ' ',
            'normal_shipment_cost'        => 'Normal Shipment Cost',
            'normal_shipment_cost_helper' => ' ',
            'fast_shipment_cost'          => 'Fast Shipment Cost',
            'fast_shipment_cost_helper'   => ' ',
            'name'                        => 'Name',
            'name_helper'                 => ' ',
        ],
    ],
    'orderManagment' => [
        'title'          => 'Order Managment',
        'title_singular' => 'Order Managment',
    ],
    'order' => [
        'title'          => 'Orders',
        'title_singular' => 'Order',
        'fields'         => [
            'id'                      => 'ID',
            'id_helper'               => ' ',
            'order_num'               => 'Order Num',
            'order_num_helper'        => ' ',
            'client_name'             => 'Client Name',
            'client_name_helper'      => ' ',
            'phone_number'            => 'Phone Number',
            'phone_number_helper'     => ' ',
            'phone_number_2'          => 'Phone Number 2',
            'phone_number_2_helper'   => ' ',
            'shipping_address'        => 'Shipping Address',
            'shipping_address_helper' => ' ',
            'delivery_status'         => 'Delivery Status',
            'delivery_status_helper'  => ' ',
            'total_cost'              => 'Total Cost',
            'total_cost_helper'       => ' ',
            'discount'                => 'Discount',
            'discount_helper'         => ' ',
            'shipment_type'           => 'Shipment Type',
            'shipment_type_helper'    => ' ',
            'city'               => 'City',
            'city_helper'        => ' ',
            'products'               => 'Products',
            'products_helper'        => ' ',
            'created_at'              => 'Created at',
            'created_at_helper'       => ' ',
            'updated_at'              => 'Updated at',
            'updated_at_helper'       => ' ',
            'deleted_at'              => 'Deleted at',
            'deleted_at_helper'       => ' ',
            'user'                    => 'User',
            'user_helper'             => ' ',
        ],
    ],
    'cart' => [
        'title'          => 'Cart',
        'title_singular' => 'Cart',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'user'              => 'User',
            'user_helper'       => ' ',
            'product'           => 'Products',
            'product_helper'    => ' ',
            'price'             => 'Price',
            'price_helper'      => ' ',
            'quantity'          => 'Quantity',
            'quantity_helper'   => ' ',
            'total_cost'        => 'Total Cost',
            'total_cost_helper' => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'orderProduct' => [
        'title'          => 'Order Product',
        'title_singular' => 'Order Product',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'product'           => 'Product',
            'product_helper'    => ' ',
            'user'              => 'User',
            'user_helper'       => ' ',
            'price'             => 'Price',
            'price_helper'      => ' ',
            'quantity'          => 'Quantity',
            'quantity_helper'   => ' ',
            'total_cost'        => 'Total Cost',
            'total_cost_helper' => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'area' => [
        'title'          => 'Areas',
        'title_singular' => 'Area',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'name'                 => 'Name',
            'name_helper'          => ' ',
            'city'                 => 'City',
            'city_helper'          => ' ',
            'shipping_cost'        => 'Shipping Cost',
            'shipping_cost_helper' => ' ',
            'active_area'          => 'Active Area',
            'active_area_helper'   => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
        ],
    ],
    'auditLog' => [
        'title'          => 'Audit Logs',
        'title_singular' => 'Audit Log',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'description'         => 'Description',
            'description_helper'  => ' ',
            'subject_id'          => 'Subject ID',
            'subject_id_helper'   => ' ',
            'subject_type'        => 'Subject Type',
            'subject_type_helper' => ' ',
            'user_id'             => 'User ID',
            'user_id_helper'      => ' ',
            'properties'          => 'Properties',
            'properties_helper'   => ' ',
            'host'                => 'Host',
            'host_helper'         => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
        ],
    ],
    'userAlert' => [
        'title'          => 'User Alerts',
        'title_singular' => 'User Alert',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'alert_text'        => 'Alert Text',
            'alert_text_helper' => ' ',
            'alert_link'        => 'Alert Link',
            'alert_link_helper' => ' ',
            'user'              => 'Users',
            'user_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
        ],
    ],
    'offer' => [
        'title'          => 'Offers',
        'title_singular' => 'Offer',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'customer' => [
        'title'          => 'Customers',
        'title_singular' => 'Customer',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'name'                  => 'Name',
            'name_helper'           => ' ',
            'email'                 => 'Email',
            'email_helper'          => ' ',
            'password'              => 'Password',
            'password_helper'       => ' ',
            'personal_photo'        => 'Personal Photo',
            'personal_photo_helper' => ' ',
            'phone'                 => 'Phone',
            'phone_helper'          => ' ',
            'address'                  => 'address',
            'address_helper'           => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',
        ],
    ],

];
