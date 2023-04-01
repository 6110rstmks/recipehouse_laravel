
{
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    authed_userid_div = document.querySelector('#nowuserid')

    // 表のレコードのuserの部分
    userids = document.querySelectorAll('.user_id')

    let nowuserid = authed_userid_div.dataset.nowuserid

    userids.forEach(userid => {
        userid.addEventListener('click', (event) => {

            if (userid.dataset.userid !== nowuserid)
            {
                event.preventDefault()
                let recipeId = userid.dataset.recipeid
                // console.log(recipeId)

                // localStorageに、レシピの最後の閲覧時間を記録する
                const lastViewedTime = localStorage.getItem(`recipe_${recipeId}_last_viewed`)

                if (lastViewedTime) {
                    // すでに一度閲覧した場合は、現在の時間と比較して1分以内であればポイントを消費しない
                    if (Date.now() - lastViewedTime < 60000) {
                        console.log("uuえ");
                        location.href = '/recipes/show/' + recipeId
                        // このコードがないと、ページが遷移せずにしたのconfirmの処理も実行されるのでエラーで強制的に止める
                        throw new Error("This is not an error. ○分イカなのでポイントを使用せずに");
                    }
                }

                if (confirm("ポイントを消費しますがよろしいですか？")) {
                    fetch('/consume', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-Token': token,
                        }
                    })
                    localStorage.setItem(`recipe_${recipeId}_last_viewed`, Date.now());
                    location.href = '/recipes/show/' + recipeId
                }
            }
        })
    })
}
