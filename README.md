## about database
a pivot table is composite key(category_id, recipe_id, user_id)
I dared to configure db without foreign key constraint.

table(category, recipe, user, tag)

## functional requirement

pagination

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
ポイントを消費して閲覧したレシピは1時間以内なら何度でも閲覧できる。

### その他

カテゴリは各ユーザがレシピを整理するためのものなので、recipelistには表示しない

## レシピ詳細ページ

ユーザはタグの新規追加はできない。
管理者がタグの管理を行い、ユーザがそれをレシピに付加する。

### タグのレシピへの付加

live searchで検索

### タグをレシピから外す
ajax

## recipehouse

### カテゴリ作成
カテゴリは同一ユーザにおいて同一名を作成できないようにする。
ただし、別のユーザとしてログインした場合は同じカテゴリを作成することができる。


レシピは異なるユーザでも

### カテゴリ名変更機能
カテゴリ名は3文字以上でないとエラーが出る。
ajax

## パスワードの再設定

## その他チェック項目
lazy loading になっていないか。
テストは書いているか。
