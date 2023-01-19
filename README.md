When doing CRUD across multiple pages like this time,
implementing ajax with vanilla js without vue.js will be full of bugs.
So I don't implement ajax in laravel-recipehouse.

## about database
a pivot table is composite key(category_id, recipe_id, user_id)
I dared to configure db without foreign key constraint.


