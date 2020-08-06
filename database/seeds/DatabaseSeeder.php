<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         $this->call(UsersTableSeeder::class);

        $user = new \App\User();
        $user->id = 1;
        $user->email = 'user@example.com';
        $user->name = "User 0";
        $user->password = bcrypt(123456);
        $user->mobile = "9898787876";
        $user->alternative_mobile = "9898787876";
        $user->save();


        $address = new \App\Models\Addresses();
        $address->user_id = 1;
        $address->salution = 'MALE';
        $address->name = 'name 1';
        $address->address = ' this is address 1';
        $address->city = 'name 2';
        $address->zipcode = '123123';
        $address->country = '123123';
        $address->state = '123123';
        $address->save();



        $fields = [ 
            [ "name" => 'Scarves', "slug"=> 'Scarves', "description"=> 'Scarves', "active"=> true, "status"=> 'ACTIVE' ],
            [ "name"=> 'Kaftans', "slug"=> 'Kaftans', "description"=> 'Kaftans', "active"=> true, "status"=> 'ACTIVE' ],
            [ "name"=> 'Parios', "slug"=> 'Parios', "description"=> 'Parios', "active"=> true, "status"=> 'ACTIVE' ],
            [ "name"=> 'Bandanas', "slug"=> 'Bandanas', "description"=> 'Bandanas', "active"=> true, "status"=> 'ACTIVE' ],
            [ "name"=> 'Footas', "slug"=> 'Footas', "description"=> 'Footas', "active"=> true, "status"=> 'ACTIVE' ]
          ];

        foreach ($fields as $field)
        {
            $item = new \App\Models\ProductCategories();
            foreach ($field as $k=>$v)
                $item->$k = $v;
            $item->save();
        }

        $products = [
            "product_category_id" => 1,
            "product_key" => 'V-neck Kaftan',
            "title"=> 'V-neck Kaftan',
            "tagline"=> 'V-neck Kaftan',
            'amount'=> '15',
//            'colorAvailable'=> ['RED'],
            'description' => 'V-neck Kaftan',
            'primary_image' => '/img/preferences.jpg',
            'status' => 'LISTED'
//            'images' => [
//                'img/product_details/small.jpg',
//                'img/product_details/small2.jpg',
//                '/img/product_details/small3.jpg',
//                '/img/product_details/small4.jpg',
//                '/img/product_details/small5.jpg'
//            ];
            ];


//        foreach ($fields as $field)
//        {
            $item = new \App\Models\Products();
            foreach ($products as $k=>$v)
                $item->$k = $v;
            $item->save();
//        }




    }
}
