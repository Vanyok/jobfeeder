<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 9/28/18
 * Time: 7:39 PM
 */
include_once('JobPost.php');

class View
{
    /**
     * @param JobPost[] $feed
     * @param int $count
     * @param int $pageSize
     * @param int $page
     */
    public function showFeed($feed, $count, $pageSize, $page = 1)
    {

        ?>
        <html class="no-js" lang="zxx">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="robots" content="index,follow">

        <title>Job Feed</title>

        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
              integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
              crossorigin="anonymous">

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
                integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
                crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
                integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
                crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
                integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
                crossorigin="anonymous"></script>
    </head>
    <body>
    <div class="container">
        <div class="row">
            <h1> Jobs feed </h1>
        </div>
        <div class=" rounded light-grey">
            <?php if ($count > 0) { ?>
                <div>


                    <?php foreach ($feed as $post) { ?>
                        <div class="row border rounded" style="margin: 10px">

                            <div class="col-md-3">
                                <img class="card-img-top" src="<?php echo $post->logo ?>"
                                     alt="<?php echo $post->title ?>" style=" height: 120px">
                            </div>
                            <div class="col-md-6" style="font-size: 11px;padding: 10px">
                                <h5 class="card-title"><?php echo $post->title ?></h5>
                                <div class="card-text"><?php echo $post->body ?></div>
                            </div>

                            <div class="col-md-3" style="color: white; background: #777;padding: 10px">
                                <h6>Address</h6>
                                <small style="color: white;"> <?php echo $post->address1 ?></small>
                                <h6>City</h6>
                                <small style="color: white;"> <?php echo $post->city ?></small>
                                <h6>Positions</h6>
                                <small style="color: white;"> <?php echo $post->numPositions ?></small>
                            </div>

                        </div>
                    <?php } ?>

                </div>
                <div class="clear"></div>
                <nav aria-label="...">
                    <ul class="pagination">
                        <?php if ($page > 1) { ?>
                            <li class="page-item ">
                                <a class="page-link" href="?page=<?php echo($page - 1) ?>" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item"><a class="page-link"
                                                     href="?page=<?php echo($page - 1) ?>"><?php echo($page - 1) ?></a>
                            </li>
                        <?php } ?>

                        <li class="page-item active">
                            <a class="page-link" href="#"><?php echo($page) ?> <span
                                        class="sr-only">(current)</span></a>
                        </li>
                        <?php if ($page < ceil($count / $pageSize)) { ?>
                            <li class="page-item"><a class="page-link"
                                                     href="?page=<?php echo($page + 1) ?>"><?php echo($page + 1) ?></a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>
            <?php } else { ?>

                <h3> no results found </h3>
            <?php } ?>
        </div>
    </div>
    </body>
        <?php
    }
}