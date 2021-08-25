$(function() {
    $('body').on('click', (e) => {
        if(!$(e.target).is('#username'))
        {
            $('#username + .header-sub-menu').hide();
        }
    });

    $('#username').on('click', (e) => {
        e.preventDefault();
        
        if($('#username + .header-sub-menu').css('display') == 'none')
        {
            $('#username + .header-sub-menu').show();
        }
        else
        {
            $('#username + .header-sub-menu').hide();
        }
    });

    $('#search').on('keyup', (e) => {
        let searchTitle = $('#search').val();
        
        if(searchTitle.length > 2)
        {
            if(e.keyCode == 13)
            {
                $('#search-btn').trigger('click');
            }
            else
            {
                getSearchResult(searchTitle);
            }
        }
        else
        {
            $('#search-result').hide();
        }
    });

    $('#search').on('click', () => {
        let searchTitle = $('#search').val();
        
        if(searchTitle.length > 2)
        {
            $('#search-result').show();
        }
    });
});


function getResultItem(anime) {
    let resultItem = document.createElement('a');
    resultItem.className = 'result-item';
    resultItem.href = 'index.php?a=anime&id=' + anime.id;

    let resultImage = document.createElement('div');
    resultImage.className = 'result-image';

    let img = new Image();
    img.src = 'public/images/anime_covers/' + anime.cover;

    resultImage.appendChild(img);
    resultItem.appendChild(resultImage);

    let resultRight = document.createElement('div');
    resultRight.className = 'result-right';

    let resultTitle = document.createElement('div');
    resultTitle.className = 'result-title';
    resultTitle.innerHTML = anime.title;

    resultRight.appendChild(resultTitle);

    let resultInfos = document.createElement('div');
    resultInfos.className = 'result-infos';

    let aired = document.createElement('div');
    aired.innerHTML = 'Aired: ' + anime.aired;

    resultInfos.appendChild(aired);

    let score = document.createElement('div');
    score.innerHTML = 'Score: ' + ((anime.score == null)? 'N/A' : anime.score);

    resultInfos.appendChild(score);

    let status = document.createElement('div');
    status.innerHTML = 'Status: ' + anime.status;

    resultInfos.appendChild(status);

    resultRight.appendChild(resultInfos);

    resultItem.appendChild(resultRight);

    return resultItem;
}

async function getSearchResult(title)
{
    $.ajax({
        url: 'index.php',
        method: 'GET',
        data: {
            a: 'search',
            q: title
        },
        success: (data) => {
            let results = JSON.parse(data);
            $('#search-result').html('');

            if(results.length == 0)
            {
                let nores = document.createElement('div');
                nores.className = 'no-result';
                nores.innerHTML = 'Pas de resultat';

                $('#search-result').append(nores);
            }
            else
            {
                for(var anime of results)
                {
                    $('#search-result').append(getResultItem(anime));
                }
            }

            $('#search-result').show();
        },
        error: (msg) => {
            console.log(msg);    
        }
    });
}