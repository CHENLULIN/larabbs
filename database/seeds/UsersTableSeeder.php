<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    //获取 Faker 实例
	    $faker = app(Faker\Generator::class);
	
	    // 头像假数据
	    $avatars = [
		    'https://cdn.learnku.com/uploads/images/201710/14/1/s5ehp11z6s.png',
		    'https://cdn.learnku.com/uploads/images/201710/14/1/Lhd1SHqu86.png',
		    'https://cdn.learnku.com/uploads/images/201710/14/1/LOnMrqbHJn.png',
		    'https://cdn.learnku.com/uploads/images/201710/14/1/xAuDMxteQy.png',
		    'https://cdn.learnku.com/uploads/images/201710/14/1/ZqM7iaP4CR.png',
		    'https://cdn.learnku.com/uploads/images/201710/14/1/NDnzMutoxX.png',
	    ];
	
	    $users = factory(User::class)
		    ->times(10)
		    ->make()
		    ->each(function ($user, $index) use($faker, $avatars)
		    {
			    //随机取出一个
			    $user->avatar = $faker->randomElement($avatars);
		    });
	
	    // 让隐藏字段可见，并将数据集合转换为数组
	    $user_array = $users->makeVisible(['password', 'remember_token'])->toArray();
	
	    // 插入到数据库中
	    User::insert($user_array);
	
	    // 单独处理第一个用户的数据
	    $user = User::find(1);
	    $user->name = "LinYuDong";
	    $user->email = "306073100@qq.com";
	    $user->avatar = "http://larabbs.test/uploads/images/avatars/2019/08/15/1_1565834810_4pB0YIzNfx.jpg";
	    $user->password = bcrypt('12345678');
	    $user->save();
    }
}
