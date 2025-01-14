<!doctype html>
<html lang="en">
<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">
</head>
<body>
<div class="container">
    @php
        $count=1;
    @endphp
    <div id="posts-container">
        @foreach(array_slice($posts, 0, 10) as $post)
            <div class="card my-4">
                <div class="card-header">
                    <h5 class="card-title">Post {{ $count }}</h5>
                </div>
                <div class="card-body">
                    <h2 class="card-title">Title</h2>
                    <p class="card-text">{{ $post['title'] }}</p>
                    <h2 class="card-title">Body</h2>
                    <p class="card-text">{{ $post['body'] }}</p>
                    <h2 class="card-title">Comments</h2>
                    <div class="comments-container" id="comments-container-{{ $post['id'] }}"></div>
                </div>
            </div>
            @php
                $count = $count+1
            @endphp
        @endforeach
    </div>
</div>

<!-- Bootstrap JS and jQuery (required for Bootstrap) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

<script>
    @foreach($posts as $post)
    fetch('https://jsonplaceholder.typicode.com/comments?postId={{ $post['id'] }}')
        .then(response => response.json())
        .then(comments => {
            const commentsContainer = document.getElementById(`comments-container-{{ $post['id'] }}`);
            comments.forEach(comment => {
                const commentDiv = document.createElement('div');
                commentDiv.classList.add('comment', 'card', 'my-2', 'bg-light');
                commentDiv.innerHTML = `
                    <div class="card-body">
                        <p class="card-text"><strong>${comment.name}</strong> - ${comment.body}</p>
                    </div>`;
                commentsContainer.appendChild(commentDiv);
            });
        })
    @endforeach
</script>
</body>
</html>
