function beginReviewWriting(){
                let container = document.getElementById('container');
                let htmlContent = `
                <div class="comment-wall">
                <div class="comment-card">
                <form action="review.store" method="POST">
                <textarea name="review" placeholder="Írd le a véleményedet!" class="rounded text-center focus:text-left p-2 w-full h-64"></textarea><br>
                <button type="submit" class="btn-new-review mt-3">Közzététel!</button>
                </form>
                </div>
                </div>
                `;
                container.innerHTML = htmlContent;
}