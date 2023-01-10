When doing CRUD across multiple pages like this time,
implementing ajax with vanilla js without vue.js will be full of bugs.
So I don't implement ajax in laravel-recipehouse.


// checkpoint1
あるユーザでログインしている状態で新規にユーザを作成すると、
そのユーザにきりかわるようにしたい。
If a user is logged in as a certain user and a new user is created I would like to switch to a new user.
// 

ユーザを作成


laravel breezeやuiを使わなくとも、
phpのログインシステムを作ったのと同じこと（sessionにuserの情報をいれて、ログイン済みかどうか判断するなど。）laravelで行えば
laravelでシステムを作れるはず、
