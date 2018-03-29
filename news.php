<?php
ob_start();
session_start();
$returnTop = false;
$action = isset($_GET['r']) ? $_GET['r'] : 'all';
$noBtns = false;
require_once 'includes/connect.php';
require_once 'includes/functions.php';
if ($action === 'all') {
    $title = 'news';
    $caption = '<h2>IEEE Latest News</h2>';
    if (isset($_SESSION['admin']) && in_array($_SESSION['admin'],[1,2])) {
        $caption .= '
        <div class="row add-news">
            <a href="news.php?r=add" id="addS">
                <div class="btn btn-lg btn-success"><i class="fa fa-plus"></i> Add News</div>
            </a>
        </div>
    ';}
    require_once 'partials/header.html';
    $query = $con->prepare('SELECT * FROM news ORDER BY DATE DESC');
    $query->execute();
    if ($query->rowCount() > 0) {
        $news = $query->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <section class="latest-news">
            <div class="container">
                <div class="row">
                    <div class="section-content">
                    <?php
                    foreach ($news as $n) {
                    $images = explode(',',$n['images']);
                    $mainImage = $images[0] === 'none' ? $images[1] : $images[0];
                    $desc_1 = decode($n['description_1']);
                    $desc_2 = decode($n['description_2']);
                    $description = !empty($desc_1)?$desc_1:$desc_2;
                    ?>
                    <div class="col-xs-6 col-md-3">
                        <div class="news-item">
                            <div class="item-meta-data">
                                <div class="col-md-8">
                                    <img src="images/latest-news-author-img.jpg" alt="image">
                                    <span>IEEE</span>
                                </div>
                                <div class="col-md-4">
                                    <span><?php echo date('M d',strtotime($n['date']));?></span>
                                </div>
                            </div>
                            <div class="item-image">
                                <a href="news.php?r=news&id=<?php echo $n['id'];?>">
                                    <span class="news-image" style="background-image:url(<?php echo $mainImage;?>);"></span>
                                </a>
                            </div>
                            <div class="item-info">
                                <h3 class="news-title"><a href="news.php?r=news&id=<?php echo $n['id'];?>"><?php echo $n['title'];?></a></h3>
                                <p><?php echo substr($description, 0, 80);?></p>
                                <a href="news.php?r=news&id=<?php echo $n['id'];?>">Read More</a>
                            </div>
                            <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] === 1) { ?>
                                <hr>
                                <div style="padding-bottom:20px;display:flex;justify-content:space-around">
                                    <a class="deleteCheck"
                                       href="<?php echo $_SERVER['PHP_SELF'] ?>?r=delete&id=<?php echo $n['id']; ?>">
                                        <div class="btn btn-danger"><i class="fa fa-remove"></i> Delete</div>
                                    </a>
                                    <a href="<?php echo $_SERVER['PHP_SELF'] ?>?r=edit&id=<?php echo $n['id']; ?>">
                                        <div class="btn btn-success"><i class="fa fa-edit"></i> Edit</div>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php } ?>
                    </div>
                </div>
            </div>
        </section>
            <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] === 1) { ?>
                <div class="alert-box hidden">
                    <div class="alert alert-danger h1">
                        Are you Sure You Want to Delete this News?
                    </div>
                    <div class="btns" style="display:flex;justify-content: space-around;align-items: center;">
                        <div data-val="1" class="btn btn-danger btn-lg confirmDelete">Yes</div>
                        <div data-val="0" class="btn btn-info btn-lg cancelDelete" style="margin-left:20px;">No</div>
                    </div>
                </div>
            <?php } ?>
                <?php
            } else {
                echo '<section class="events-list text-center h1" style="margin:0;">No News Added</section>';
            }
} elseif ($action === 'news') {
    if (isset($_GET['id'])) {

        $query = $con->prepare('SELECT * FROM news WHERE id=?');
        $query->execute(array($_GET['id']));
        if ($query->rowCount() > 0) {
            $news = $query->fetchAll(PDO::FETCH_ASSOC)[0];
            $title = ucfirst($news['title']);
            $caption = '<h2>'.$title.'</h2>';
            $headerClass = "news-single-hero";
            require_once 'partials/header.html';
            $images = explode(',',$news['images']);
            $image_1 = $images[0] === 'none'? null : $images[0];
            $image_2 = $images[1] === 'none'? null : $images[1];
            $desc_1 = decode($news['description_1']);
            $desc_2 = decode($news['description_2']);
        ?>
            <section class="news-single-meta">
                <div class="container">
                    <div class="row">
                        <p>Published in <a href="https://spectrum.ieee.org/telecom/internet/make-the-web-better-for-everyone" target="_blank">IEEE</a></p>
                        <p>September, 21th 2017</p>
                    </div>
                </div>
            </section>

            <section class="news-single-content">
                <div class="container">
                    <div class="row">
                        <div class="section-content">
                            <?php if ($image_1) {?>
                            <section class="news-single-full-image">
                                <center><img src="<?php echo $image_1;?>" alt="<?php echo ucfirst($news['title']);?>"></center>
                            </section>
                            <?php } ?>
                            <?php if (strlen($desc_1) !==0){?>
                            <p><?php echo $desc_1;?></p>
                            <?php } ?>
                            <?php if($image_2){?>
                            <section class="news-single-full-image">
                                <center><img src="<?php echo $image_2;?>" alt="<?php echo ucfirst($news['title']);?>"></center>
                            </section>
                            <br><br><br>
                            <?php } ?>
                            <?php if (strlen($desc_2) !==0){?>
                                <p><?php echo $desc_2;?></p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </section>
            <?php
            $query = $con->prepare('SELECT * FROM news ORDER BY DATE DESC LIMIT 4');
            $query->execute();
            $noBtns = true;
            if ($query->rowCount() > 0) {
                $news = $query->fetchAll(PDO::FETCH_ASSOC);

                ?>
        <section class="latest-news-single ">
            <div class="container ">
                <h2 class="related-heading "><span>Related Articles</span></h2>
                <div class="row ">
                    <div class="section-content ">
                <?php
                foreach ($news as $n) {
                    $images = explode(',',$n['images']);
                    $mainImage = $images[0] === 'none' ? $images[1] : $images[0];
                    $desc_1 = decode($n['description_1']);
                    $desc_2 = decode($n['description_2']);
                    $description = !empty($desc_1)?$desc_1:$desc_2;
                    ?>

                    <div class="col-xs-6 col-md-3">
                        <div class="news-item">
                            <div class="item-meta-data">
                                <div class="col-md-8">
                                    <img src="images/latest-news-author-img.jpg" alt="image">
                                    <span>IEEE</span>
                                </div>
                                <div class="col-md-4">
                                    <span><?php echo date('M d',strtotime($n['date']));?></span>
                                </div>
                            </div>
                            <div class="item-image">
                                <a href="news.php?r=news&id=<?php echo $n['id'];?>">
                                    <span class="news-image" style="background-image:url(<?php echo $mainImage;?>);"></span>
                                </a>
                            </div>
                            <div class="item-info">
                                <h3 class="news-title"><a href="news.php?r=news&id=<?php echo $n['id'];?>"><?php echo $n['title'];?></a></h3>
                                <p><?php echo substr($description, 0, 80);?></p>
                                <a href="news.php?r=news&id=<?php echo $n['id'];?>">Read More</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                    </div>
                </div>
            </div>
        </section>
            <?php } else {
                echo '<section class="events-list text-center">No More News</section>';
            }
        } else {
            header("Location:news.php");
            exit();
        }
    } else {
        header("Location:news.php");
        exit();
    }
}  elseif (isset($_SESSION['admin']) && in_array($_SESSION['admin'],[1,2,3])) {
    $title='';
    $caption='';
    if ($action === 'add' && $_SESSION['admin'] === 1) {
        $noBtns = true;
        $title="Add News";
        $caption="";
        $headerClass='default-hero';
        require_once 'partials/header.html';
        ?>
        <section class="add-event-form">
            <div class="container">
                <form action="<?php echo $_SERVER['PHP_SELF'] . '?r=insert' ?>" id="news-form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label">News Title:</label>
                        <input type="text" data-check="[^A-Za-z0-9. ]" class="form-control"  id="event-name" placeholder="News Title" name="name">
                    </div>
                    <div class="form-group">
                        <label class="control-label">News Date:</label>
                        <input type="text" class="form-control" name="date" placeholder="MM/DD/YYYY">
                    </div>
                    <div class="form-group">
                        <label class="control-label">News Main Image:</label>
                        <input name="top_image" type="file" onchange="ValidateSingleInput(this);">
                    </div>
                    <div class="form-group">
                        <label class="control-label">News Content:</label>
                        <textarea name="description_1" class="form-control textarea" cols="30" rows="10" data-check="[^A-Za-z0-9.\\- ,]" placeholder="Add Your Content"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="control-label">News Image at Middle:</label>
                        <input name="middle_image" id="second_image" type="file">
                    </div>
                    <div class="form-group hidden">
                        <label class="control-label">News Content After Image:</label>
                        <textarea name="description_2" class="form-control textarea" cols="30" rows="10" data-check="[^A-Za-z0-9.\\- ,]" placeholder="Leave Empty if you don't want to add More Content"></textarea>
                    </div>
                    <input type="submit" class="btn btn-success" id="submit" value="Submit">
                </form>
            </div>
        </section>
        <script src="js/news_validation.js"></script>
    <?php } elseif ($action === 'insert') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //TODO: insert news in db
            $data = filter_var_array($_POST, FILTER_SANITIZE_STRING);
            $name = $data['name'];
            $date = date('Y-m-d',strtotime($data['date']));
            $desc_1 = empty($data['description_1']) ? '':encode($data['description_1']);
            $desc_2 = empty($data['description_2']) ? '':encode($data['description_2']);
            $images = '';
            if (strlen($_FILES['top_image']['name'])!==0) {
                $image_1 = 'images/news/' . sha1(substr($_FILES['top_image']['name'], 0, strlen($_FILES['top_image']['name']) - 5)) . substr($_FILES['top_image']['name'], strlen($_FILES['top_image']['name']) - 4);
                $images .= $image_1;
                move_uploaded_file($_FILES['top_image']['tmp_name'], $image_1);
            } else{
                $images .= 'none';
            }
            if (strlen($_FILES['middle_image']['name'])!==0) {
                $image_2 = 'images/news/' . sha1(substr($_FILES['middle_image']['name'], 0, strlen($_FILES['middle_image']['name']) - 5)) . substr($_FILES['middle_image']['name'], strlen($_FILES['middle_image']['name']) - 4);
                $images .= ','.$image_2;
                move_uploaded_file($_FILES['middle_image']['tmp_name'], $image_2);
            } else {
                $images .= ',none';
            }
            if ($images === '') {
                $images = 'http://picsum.photos/1920';
            }
            $query = $con->prepare("INSERT INTO news (title,date,description_1,description_2,images) VALUES (?,?,?,?,?)");
            $query->execute(array($name,$date,$desc_1,$desc_2,$images));
            $title = '';
            $caption = '';
            $headerClass='default-hero';
            require_once 'partials/header.html';
            ?>
            <div class="alert alert-success text-center others-section" style="font-size:30px;margin-top:0;">Adding Your News</div>
            <?php
            header("refresh:1;url=news.php");
            exit();
        } else {
            header("refresh:0;url=news.php");
            exit();
        }
    } elseif ($action === 'delete') {
        $query = $con->prepare("DELETE FROM `news` WHERE `id` = ?");
        $query->execute(array($_GET['id']));
        header("refresh:0;url=news.php");
        exit();
    } elseif ($action === 'edit') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $query = $con->prepare("SELECT * FROM `news` WHERE id = ?");
            $query->execute(array($id));
            if ($query->rowCount() > 0) {
                $news = $query->fetch(PDO::FETCH_ASSOC);
                $title=ucfirst($news['title']);
                require_once 'partials/header.html';
                ?>
                <section class="add-event-form">
                    <div class="container">
                        <form action="<?php echo $_SERVER['PHP_SELF'] . '?r=update' ?>" id="news-edit-form" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $news['id'];?>">
                            <div class="form-group">
                                <label class="control-label">News Title:</label>
                                <input type="text" data-check="[^A-Za-z0-9. ]" class="form-control"  id="event-name" placeholder="News Title" name="name" value="<?php echo $news['title'];?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label">News Date:</label>
                                <input type="text" class="form-control" name="date" placeholder="MM/DD/YYYY"value="<?php echo date('m/d/Y',strtotime($news['date']));?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label">News Main Image:</label>
                                <input name="top_image" type="file" onchange="ValidateSingleInput(this);">
                            </div>
                            <div class="form-group">
                                <label class="control-label">News Content:</label>
                                <textarea name="description_1" class="form-control textarea" cols="30" rows="10" data-check="[^A-Za-z0-9.\\- ,]" placeholder="Add Your Content"><?php echo $news['description_1'];?></textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label">News Image at Middle:</label>
                                <input name="middle_image" id="second_image" type="file">
                            </div>
                            <div class="form-group hidden">
                                <label class="control-label">News Content After Image:</label>
                                <textarea name="description_2" class="form-control textarea" cols="30" rows="10" data-check="[^A-Za-z0-9.\\- ,]" placeholder="Leave Empty if you don't want to add More Content"><?php echo $news['description_2'];?></textarea>
                            </div>
                            <input type="submit" class="btn btn-success" id="submit" value="Submit">
                        </form>
                    </div>
                </section>
                <script src="js/news_validation.js"></script>
                <?php
            } else {
                header("refresh:0;url=news.php");
                exit();
            }
        } else {
            header("refresh:0;url=news.php");
            exit();
        }
    } elseif ($action === 'update') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['id'])) {
                $id=$_POST['id'];
                $query=$con->prepare("SELECT * FROM news WHERE id = ?");
                $query->execute(array($id));
                if ($query->rowCount() > 0) {
                    $data = filter_var_array($_POST, FILTER_SANITIZE_STRING);
                    $name = $data['name'];
                    $date = date('Y-m-d',strtotime($data['date']));
                    $desc_1 = empty($data['description_1']) ? '':encode($data['description_1']);
                    $desc_2 = empty($data['description_2']) ? '':encode($data['description_2']);
                    $images = '';
                    $oldImages = explode(',',$query->fetch(PDO::FETCH_ASSOC)['images']);
                    print_r($oldImages);
                    foreach ($oldImages as $i => $img) {
                        if ($img === 'none') {
                            $oldImages[$i] = '';
                        }
                    }
                    print_r($oldImages);
                    if (strlen($_FILES['top_image']['name']) !== 0) {
                        $image_1 = 'images/news/' . sha1(substr($_FILES['top_image']['name'], 0, strlen($_FILES['top_image']['name']) - 5)) . substr($_FILES['top_image']['name'], strlen($_FILES['top_image']['name']) - 4);
                        echo $image_1 . '<br/>';
                        if($image_1 !== $oldImages[0]) {
                            move_uploaded_file($_FILES['top_image']['tmp_name'], $image_1);
                            $images .= $image_1;
                        }
                    } else {
                        $images .= $oldImages[0];
                    }
                    if (strlen($_FILES['middle_image']['name']) !== 0) {
                        $image_2 = 'images/news/' . sha1(substr($_FILES['middle_image']['name'], 0, strlen($_FILES['middle_image']['name']) - 5)) . substr($_FILES['middle_image']['name'], strlen($_FILES['middle_image']['name']) - 4);
                        if($image_2 !== $oldImages[1]) {
                            move_uploaded_file($_FILES['middle_image']['tmp_name'], $image_2);
                            $images .= ',' . $image_2;
                        }
                    } else {
                        $images .= ','.$oldImages[1];
                    }
                    if ($images === '') {
                        $images = 'http://picsum.photos/1920,none';
                    }
                    $query = $con->prepare("UPDATE news SET title=?,date=?,description_1=?,description_2=?,images=?");
                    $query->execute(array($name, $date, $desc_1, $desc_2, $images));
                }
            }
            header("refresh:0;url=news.php");
            exit();
        } else {
            header("refresh:0;url=news.php");
            exit();
        }
    } else {
        header("refresh:0;url=news.php");
        exit();
    }
} else {
    header("refresh:0;url=news.php");
    exit();
}
?>
<?php
    require_once 'partials/footer.html';
    ob_end_flush();
?>