## about database
a pivot table is composite key(category_id, recipe_id, user_id)
I dared to configure db without foreign key constraint.

## functional requirement

pagination
many-to-many(user-category-recipe)

レシピ一覧リストにおいて、ajaxのdeleteができる（☓ボタンが表示される）（自分が作成したレシピの場合）
管理者はpruneができる。

レシピ一覧リストからカテゴリを選択(ajaxで取得)してレシピをajaxで追加することができる。（ログイン時のみレシピを登録できる）

# authentication

reset-mail for forgetting-password

## recipelist

### 足跡機能
あるユーザがレシピを閲覧するとカウントが1増える。
5分以内に同じユーザが再度レシピを見ても（リロードや、ページをまたいで再びレシピを閲覧）カウントは増えない。

自身のレシピを閲覧してもカウントは増えない。

### レシピ作成者の表示

退会したユーザのレシピは削除されない。
退会したユーザのレシピの作成者の名前は「退会したユーザ」。

### ポイント消費、有料会員

消費ポイントはconfig/recipe.phpに記載

