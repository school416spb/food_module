<!--2021 (с) Давыдов Д.Э., davydov@school416spb.ru-->
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>food</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/dde0e1be1e.js"></script>
</head>

<body>

    <?php
      /*код доступа при загрузке и удалении файлов на текущую дату*/
      $main_code = "12345";
      /*код доступа для удаления всех файлов директории*/
      $del_code = "12345";
      /*имя директории в которой работает скрипт*/
      $way = "food";
    ?>

    <div class="container">
        
        <div class="row">
            
            <div class="col-12 col-sm-6">
                
                <h1 class="text-primary">Загрузка файла меню</h1>
                
                <?php
                
                    if (isset($_POST['upload'])){
                        
                        if (htmlspecialchars($_POST['psswd']==$main_code)){

                        if ($_POST['role'] == "1"){
                            $name = $_POST['date']."-sm.xlsx";  
                        } else $name = $_POST['date']."-ss.xlsx";
                            
                          if(is_uploaded_file($_FILES["filename"]["tmp_name"])){
                              
                                 $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            
            				     move_uploaded_file($_FILES["filename"]["tmp_name"], $_FILES["filename"]["name"]);
            				     rename($_FILES["filename"]["name"], $name);
            				     echo '<p class="text-success"><i class="fa fa-check-circle" aria-hidden="true"></i> файл загружен!</span>';
            				     echo '<meta http-equiv="refresh" content="1; url='.$url.'">';

            			    }
                            
                        } else echo '<p class="text-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> неверный код подтверждения!</span>';
                        
                    }
                
                ?>
                
                <form method="POST" enctype="multipart/form-data">
                    
                    <p>
                        <input type="file" name="filename" class="form-control" required="" style="height: auto;" accept=".xlsx">
                    </p>
                    <p>
                        <select class="form-control" name="role" required="">
                            <option></option>
                            <option value="1">1 - 4 параллель</option>
                            <option value="2">5 - 11 параллель</option>
                        </select>
                    </p>
                    <p>
                        <input type="date" name="date" class="form-control" required="" value="<?php echo date("Y-m-d"); ?>" required="">
                    </p>
                    <p>
                        <input type="password" name="psswd" class="form-control" placeholder="Код подтверждения" required="" autocomplete="off">
                    </p>
                    <p>
                        <button type="submit" name="upload" class="btn btn-outline-primary"><i class="fa fa-upload" aria-hidden="true"></i> Загрузить</button>
                        <button type="reset" name="reset" class="btn btn-outline-danger"><i class="fa fa-eraser" aria-hidden="true"></i> Очистить</button>
                    </p>
                    
                </form>
                
            </div>
            
            <div class="col-12 col-sm-6">
                
                <h1 class="text-primary">Мониторинг</h1>
                
                <table class="table table-hover table-bordered text-center">
                    
                    <tr>
                        <th colspan="2">Сегодня <?php echo date("d.m.Y"); ?> года</th>
                    </tr>
                    
                    <tr>
                        
                        <th>Начальная школа</th>
                        <th>Основная, средняя школа</th>
                        
                    </tr>
                    
                    <tr>
                        
                        <td>
                            
                            <?php 
                            
                                $name1 = date("Y-m-d")."-sm.xlsx";
                                $name2 = date("Y-m-d")."-ss.xlsx";
                                
                                $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                            
                                if(file_exists($name1)){
                                    echo '<span class="text-success">файл загружен</span><br>';
                                    echo '<a href="http://docs.google.com/viewer?url='.$url.$name1.'">'.$name1.'</a> ';
                                    echo '<button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#Modal_sm">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i></button>';
                                } else echo '<span class="text-danger">файл не загружен</span>';
                            ?>
                            
                        </td>
                        
                        <td>
                            
                            <?php 
                            
                                if(file_exists($name2)){
                                    echo '<span class="text-success">файл загружен</span><br>';
                                    echo '<a href="http://docs.google.com/viewer?url='.$url.$name2.'">'.$name2.'</a> ';
                                    echo '<button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#Modal_ss">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i></button>';
                                } else echo '<span class="text-danger">файл не загружен</span>';
                            
                            ?>
                            
                        </td>
                        
                    </tr>
                    
                </table>
            </div>
            
            <div class="col-12">
                <hr>
                <h1 class="text-primary">Статистика</h1>
                
                <p>
                  <a class="btn btn-outline-secondary" data-toggle="collapse" href="#sep" role="button" aria-expanded="false" aria-controls="sep"><i class="fa fa-search" aria-hidden="true"></i> Сентябрь</a>
                  <a class="btn btn-outline-secondary" data-toggle="collapse" href="#oct" role="button" aria-expanded="false" aria-controls="oct"><i class="fa fa-search" aria-hidden="true"></i> Октябрь</a>
                  <a class="btn btn-outline-secondary" data-toggle="collapse" href="#nov" role="button" aria-expanded="false" aria-controls="nov"><i class="fa fa-search" aria-hidden="true"></i> Ноябрь</a>
                  <a class="btn btn-outline-secondary" data-toggle="collapse" href="#dec" role="button" aria-expanded="false" aria-controls="dec"><i class="fa fa-search" aria-hidden="true"></i> Декабрь</a>
                  <a class="btn btn-outline-secondary" data-toggle="collapse" href="#jan" role="button" aria-expanded="false" aria-controls="jan"><i class="fa fa-search" aria-hidden="true"></i> Январь</a>
                  <a class="btn btn-outline-secondary" data-toggle="collapse" href="#feb" role="button" aria-expanded="false" aria-controls="feb"><i class="fa fa-search" aria-hidden="true"></i> Февраль</a>
                  <a class="btn btn-outline-secondary" data-toggle="collapse" href="#mar" role="button" aria-expanded="false" aria-controls="mar"><i class="fa fa-search" aria-hidden="true"></i> Март</a>
                  <a class="btn btn-outline-secondary" data-toggle="collapse" href="#apr" role="button" aria-expanded="false" aria-controls="apr"><i class="fa fa-search" aria-hidden="true"></i> Апрель</a>
                  <a class="btn btn-outline-secondary" data-toggle="collapse" href="#may" role="button" aria-expanded="false" aria-controls="may"><i class="fa fa-search" aria-hidden="true"></i> Май</a>
                </p>
                <div class="row">
                    
                  <div class="col-12">
                    <div class="collapse multi-collapse" id="sep">
                      <div class="card card-body">
                        
                        <div class="table-responsive">
                        <table class="table table-hover table-bordered text-center table-sm">
                            
                            <tr><th colspan="2">Сентябрь</th></tr>
                    
                            <tr>
                                
                                <th>Начальная школа</th>
                                <th>Основная, средняя школа</th>
                                
                            </tr>
                            <tr><td>        
                                <?php
                                    
                                    $dir  = '../'.$way.'/';
                                    $files = array_diff( scandir( $dir), array('..', '.'));
                                    foreach($files AS $i => $filename) {
                                        
                                        $month1 = $filename[5].$filename[6];
                                        
                                        $find1 = strpos($filename, ".xlsx");
                                        $find2 = strpos($filename, "sm");
                                        
                                        $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                                        
                                        if (($find1 == TRUE)&&($find2 == TRUE)&&($month1 == "09")){ printf(
                                            '<a href="http://docs.google.com/viewer?url='.$url.'%s">%s</a><br>',
                                            rawurlencode($filename),
                                            $filename
                                          );
                                         }
                                      }
                                ?>
                                </td>
                                <td>
                                    <?php
                                    
                                    $dir  = '../'.$way.'/';
                                    $files = array_diff( scandir( $dir), array('..', '.'));
                                    foreach($files AS $i => $filename) {
                                        
                                        $month2 = $filename[5].$filename[6];
                                        
                                        $find3 = strpos($filename, ".xlsx");
                                        $find4 = strpos($filename, "ss");
                                        
                                        $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                                        
                                        if (($find3 == TRUE)&&($find4 == TRUE)&&($month2 == "09")){ printf(
                                            '<a href="http://docs.google.com/viewer?url='.$url.'%s">%s</a><br>',
                                            rawurlencode($filename),
                                            $filename
                                          );
                                         }
                                      }
                                ?>
                                </td></tr>
                        </table>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-12">
                    <div class="collapse multi-collapse" id="oct">
                      <div class="card card-body">
                        
                        <div class="table-responsive">
                        <table class="table table-hover table-bordered text-center table-sm">
                            
                            <tr><th colspan="2">Октябрь</th></tr>
                    
                            <tr>
                                
                                <th>Начальная школа</th>
                                <th>Основная, средняя школа</th>
                                
                            </tr>
                            <tr><td>        
                                <?php
                                    
                                    $dir  = '../'.$way.'/';
                                    $files = array_diff( scandir( $dir), array('..', '.'));
                                    foreach($files AS $i => $filename) {
                                        
                                        $month1 = $filename[5].$filename[6];
                                        
                                        $find1 = strpos($filename, ".xlsx");
                                        $find2 = strpos($filename, "sm");
                                        
                                        $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                                        
                                        if (($find1 == TRUE)&&($find2 == TRUE)&&($month1 == "10")){ printf(
                                            '<a href="http://docs.google.com/viewer?url='.$url.'%s">%s</a><br>',
                                            rawurlencode($filename),
                                            $filename
                                          );
                                         }
                                      }
                                ?>
                                </td>
                                <td>
                                    <?php
                                    
                                    $dir  = '../'.$way.'/';
                                    $files = array_diff( scandir( $dir), array('..', '.'));
                                    foreach($files AS $i => $filename) {
                                        
                                        $month2 = $filename[5].$filename[6];
                                        
                                        $find3 = strpos($filename, ".xlsx");
                                        $find4 = strpos($filename, "ss");
                                        
                                        $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                                        
                                        if (($find3 == TRUE)&&($find4 == TRUE)&&($month2 == "10")){ printf(
                                            '<a href="http://docs.google.com/viewer?url='.$url.'%s">%s</a><br>',
                                            rawurlencode($filename),
                                            $filename
                                          );
                                         }
                                      }
                                ?>
                                </td></tr>
                        </table>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-12">
                    <div class="collapse multi-collapse" id="nov">
                      <div class="card card-body">
                        
                        <div class="table-responsive">
                        <table class="table table-hover table-bordered text-center table-sm">
                            
                            <tr><th colspan="2">Ноябрь</th></tr>
                    
                            <tr>
                                
                                <th>Начальная школа</th>
                                <th>Основная, средняя школа</th>
                                
                            </tr>
                            <tr><td>        
                                <?php
                                    
                                    $dir  = '../'.$way.'/';
                                    $files = array_diff( scandir( $dir), array('..', '.'));
                                    foreach($files AS $i => $filename) {
                                        
                                        $month1 = $filename[5].$filename[6];
                                        
                                        $find1 = strpos($filename, ".xlsx");
                                        $find2 = strpos($filename, "sm");
                                        
                                        $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                                        
                                        if (($find1 == TRUE)&&($find2 == TRUE)&&($month1 == "11")){ printf(
                                            '<a href="http://docs.google.com/viewer?url='.$url.'%s">%s</a><br>',
                                            rawurlencode($filename),
                                            $filename
                                          );
                                         }
                                      }
                                ?>
                                </td>
                                <td>
                                    <?php
                                    
                                    $dir  = '../'.$way.'/';
                                    $files = array_diff( scandir( $dir), array('..', '.'));
                                    foreach($files AS $i => $filename) {
                                        
                                        $month2 = $filename[5].$filename[6];
                                        
                                        $find3 = strpos($filename, ".xlsx");
                                        $find4 = strpos($filename, "ss");
                                        
                                        $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                                        
                                        if (($find3 == TRUE)&&($find4 == TRUE)&&($month2 == "11")){ printf(
                                            '<a href="http://docs.google.com/viewer?url='.$url.'%s">%s</a><br>',
                                            rawurlencode($filename),
                                            $filename
                                          );
                                         }
                                      }
                                ?>
                                </td></tr>
                        </table>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-12">
                    <div class="collapse multi-collapse" id="dec">
                      <div class="card card-body">
                        
                        <div class="table-responsive">
                        <table class="table table-hover table-bordered text-center table-sm">
                            
                            <tr><th colspan="2">Декабрь</th></tr>
                    
                            <tr>
                                
                                <th>Начальная школа</th>
                                <th>Основная, средняя школа</th>
                                
                            </tr>
                            <tr><td>        
                                <?php
                                    
                                    $dir  = '../'.$way.'/';
                                    $files = array_diff( scandir( $dir), array('..', '.'));
                                    foreach($files AS $i => $filename) {
                                        
                                        $month1 = $filename[5].$filename[6];
                                        
                                        $find1 = strpos($filename, ".xlsx");
                                        $find2 = strpos($filename, "sm");
                                        
                                        $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                                        
                                        if (($find1 == TRUE)&&($find2 == TRUE)&&($month1 == "12")){ printf(
                                            '<a href="http://docs.google.com/viewer?url='.$url.'%s">%s</a><br>',
                                            rawurlencode($filename),
                                            $filename
                                          );
                                         }
                                      }
                                ?>
                                </td>
                                <td>
                                    <?php
                                    
                                    $dir  = '../'.$way.'/';
                                    $files = array_diff( scandir( $dir), array('..', '.'));
                                    foreach($files AS $i => $filename) {
                                        
                                        $month2 = $filename[5].$filename[6];
                                        
                                        $find3 = strpos($filename, ".xlsx");
                                        $find4 = strpos($filename, "ss");
                                        
                                        $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                                        
                                        if (($find3 == TRUE)&&($find4 == TRUE)&&($month2 == "12")){ printf(
                                            '<a href="http://docs.google.com/viewer?url='.$url.'%s">%s</a><br>',
                                            rawurlencode($filename),
                                            $filename
                                          );
                                         }
                                      }
                                ?>
                                </td></tr>
                        </table>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-12">
                    <div class="collapse multi-collapse" id="jan">
                      <div class="card card-body">
                        
                        <div class="table-responsive">
                        <table class="table table-hover table-bordered text-center table-sm">
                            
                            <tr><th colspan="2">Январь</th></tr>
                    
                            <tr>
                                
                                <th>Начальная школа</th>
                                <th>Основная, средняя школа</th>
                                
                            </tr>
                            <tr><td>        
                                <?php
                                    
                                    $dir  = '../'.$way.'/';
                                    $files = array_diff( scandir( $dir), array('..', '.'));
                                    foreach($files AS $i => $filename) {
                                        
                                        $month1 = $filename[5].$filename[6];
                                        
                                        $find1 = strpos($filename, ".xlsx");
                                        $find2 = strpos($filename, "sm");
                                        
                                        $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                                        
                                        if (($find1 == TRUE)&&($find2 == TRUE)&&($month1 == "01")){ printf(
                                            '<a href="http://docs.google.com/viewer?url='.$url.'%s">%s</a><br>',
                                            rawurlencode($filename),
                                            $filename
                                          );
                                         }
                                      }
                                ?>
                                </td>
                                <td>
                                    <?php
                                    
                                    $dir  = '../'.$way.'/';
                                    $files = array_diff( scandir( $dir), array('..', '.'));
                                    foreach($files AS $i => $filename) {
                                        
                                        $month2 = $filename[5].$filename[6];
                                        
                                        $find3 = strpos($filename, ".xlsx");
                                        $find4 = strpos($filename, "ss");
                                        
                                        $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                                        
                                        if (($find3 == TRUE)&&($find4 == TRUE)&&($month2 == "01")){ printf(
                                            '<a href="http://docs.google.com/viewer?url='.$url.'%s">%s</a><br>',
                                            rawurlencode($filename),
                                            $filename
                                          );
                                         }
                                      }
                                ?>
                                </td></tr>
                        </table>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-12">
                    <div class="collapse multi-collapse" id="feb">
                      <div class="card card-body">
                        
                        <div class="table-responsive">
                        <table class="table table-hover table-bordered text-center table-sm">
                            
                            <tr><th colspan="2">Февраль</th></tr>
                    
                            <tr>
                                
                                <th>Начальная школа</th>
                                <th>Основная, средняя школа</th>
                                
                            </tr>
                            <tr><td>        
                                <?php
                                    
                                    $dir  = '../'.$way.'/';
                                    $files = array_diff( scandir( $dir), array('..', '.'));
                                    foreach($files AS $i => $filename) {
                                        
                                        $month1 = $filename[5].$filename[6];
                                        
                                        $find1 = strpos($filename, ".xlsx");
                                        $find2 = strpos($filename, "sm");
                                        
                                        $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                                        
                                        if (($find1 == TRUE)&&($find2 == TRUE)&&($month1 == "02")){ printf(
                                            '<a href="http://docs.google.com/viewer?url='.$url.'%s">%s</a><br>',
                                            rawurlencode($filename),
                                            $filename
                                          );
                                         }
                                      }
                                ?>
                                </td>
                                <td>
                                    <?php
                                    
                                    $dir  = '../'.$way.'/';
                                    $files = array_diff( scandir( $dir), array('..', '.'));
                                    foreach($files AS $i => $filename) {
                                        
                                        $month2 = $filename[5].$filename[6];
                                        
                                        $find3 = strpos($filename, ".xlsx");
                                        $find4 = strpos($filename, "ss");
                                        
                                        $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                                        
                                        if (($find3 == TRUE)&&($find4 == TRUE)&&($month2 == "02")){ printf(
                                            '<a href="http://docs.google.com/viewer?url='.$url.'%s">%s</a><br>',
                                            rawurlencode($filename),
                                            $filename
                                          );
                                         }
                                      }
                                ?>
                                </td></tr>
                        </table>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-12">
                    <div class="collapse multi-collapse" id="mar">
                      <div class="card card-body">
                        
                        <div class="table-responsive">
                        <table class="table table-hover table-bordered text-center table-sm">
                            
                            <tr><th colspan="2">Март</th></tr>
                    
                            <tr>
                                
                                <th>Начальная школа</th>
                                <th>Основная, средняя школа</th>
                                
                            </tr>
                            <tr><td>        
                                <?php
                                    
                                    $dir  = '../'.$way.'/';
                                    $files = array_diff( scandir( $dir), array('..', '.'));
                                    foreach($files AS $i => $filename) {
                                        
                                        $month1 = $filename[5].$filename[6];
                                        
                                        $find1 = strpos($filename, ".xlsx");
                                        $find2 = strpos($filename, "sm");
                                        
                                        $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                                        
                                        if (($find1 == TRUE)&&($find2 == TRUE)&&($month1 == "03")){ printf(
                                            '<a href="http://docs.google.com/viewer?url='.$url.'%s">%s</a><br>',
                                            rawurlencode($filename),
                                            $filename
                                          );
                                         }
                                      }
                                ?>
                                </td>
                                <td>
                                    <?php
                                    
                                    $dir  = '../'.$way.'/';
                                    $files = array_diff( scandir( $dir), array('..', '.'));
                                    foreach($files AS $i => $filename) {
                                        
                                        $month2 = $filename[5].$filename[6];
                                        
                                        $find3 = strpos($filename, ".xlsx");
                                        $find4 = strpos($filename, "ss");
                                        
                                        $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                                        
                                        if (($find3 == TRUE)&&($find4 == TRUE)&&($month2 == "03")){ printf(
                                            '<a href="http://docs.google.com/viewer?url='.$url.'%s">%s</a><br>',
                                            rawurlencode($filename),
                                            $filename
                                          );
                                         }
                                      }
                                ?>
                                </td></tr>
                        </table>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-12">
                    <div class="collapse multi-collapse" id="apr">
                      <div class="card card-body">
                        
                        <div class="table-responsive">
                        <table class="table table-hover table-bordered text-center table-sm">
                            
                            <tr><th colspan="2">Апрель</th></tr>
                    
                            <tr>
                                
                                <th>Начальная школа</th>
                                <th>Основная, средняя школа</th>
                                
                            </tr>
                            <tr><td>        
                                <?php
                                    
                                    $dir  = '../'.$way.'/';
                                    $files = array_diff( scandir( $dir), array('..', '.'));
                                    foreach($files AS $i => $filename) {
                                        
                                        $month1 = $filename[5].$filename[6];
                                        
                                        $find1 = strpos($filename, ".xlsx");
                                        $find2 = strpos($filename, "sm");
                                        
                                        $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                                        
                                        if (($find1 == TRUE)&&($find2 == TRUE)&&($month1 == "04")){ printf(
                                            '<a href="http://docs.google.com/viewer?url='.$url.'%s">%s</a><br>',
                                            rawurlencode($filename),
                                            $filename
                                          );
                                         }
                                      }
                                ?>
                                </td>
                                <td>
                                    <?php
                                    
                                    $dir  = '../'.$way.'/';
                                    $files = array_diff( scandir( $dir), array('..', '.'));
                                    foreach($files AS $i => $filename) {
                                        
                                        $month2 = $filename[5].$filename[6];
                                        
                                        $find3 = strpos($filename, ".xlsx");
                                        $find4 = strpos($filename, "ss");
                                        
                                        $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                                        
                                        if (($find3 == TRUE)&&($find4 == TRUE)&&($month2 == "04")){ printf(
                                            '<a href="http://docs.google.com/viewer?url='.$url.'%s">%s</a><br>',
                                            rawurlencode($filename),
                                            $filename
                                          );
                                         }
                                      }
                                ?>
                                </td></tr>
                        </table>
                        </div>
                        
                        
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-12">
                    <div class="collapse multi-collapse" id="may">
                      <div class="card card-body">
                        
                        <div class="table-responsive">
                        <table class="table table-hover table-bordered text-center table-sm">
                            
                            <tr><th colspan="2">Май</th></tr>
                    
                            <tr>
                                
                                <th>Начальная школа</th>
                                <th>Основная, средняя школа</th>
                                
                            </tr>
                            <tr><td>        
                                <?php
                                    
                                    $dir  = '../'.$way.'/';
                                    $files = array_diff( scandir( $dir), array('..', '.'));
                                    foreach($files AS $i => $filename) {
                                        
                                        $month1 = $filename[5].$filename[6];
                                        
                                        $find1 = strpos($filename, ".xlsx");
                                        $find2 = strpos($filename, "sm");
                                        
                                        $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                                        
                                        if (($find1 == TRUE)&&($find2 == TRUE)&&($month1 == "05")){ printf(
                                            '<a href="http://docs.google.com/viewer?url='.$url.'%s">%s</a><br>',
                                            rawurlencode($filename),
                                            $filename
                                          );
                                         }
                                      }
                                ?>
                                </td>
                                <td>
                                    <?php
                                    
                                    $dir  = '../'.$way.'/';
                                    $files = array_diff( scandir( $dir), array('..', '.'));
                                    foreach($files AS $i => $filename) {
                                        
                                        $month2 = $filename[5].$filename[6];
                                        
                                        $find3 = strpos($filename, ".xlsx");
                                        $find4 = strpos($filename, "ss");
                                        
                                        $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                                        
                                        if (($find3 == TRUE)&&($find4 == TRUE)&&($month2 == "05")){ printf(
                                            '<a href="http://docs.google.com/viewer?url='.$url.'%s">%s</a><br>',
                                            rawurlencode($filename),
                                            $filename
                                          );
                                         }
                                      }
                                ?>
                                </td></tr>
                        </table>
                        </div>
                        
                      </div>
                    </div>
                  </div>

                </div>
                
            </div>
            
            <div class="col-12">
                <hr>
                <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#Modal_DEL">
                  <i class="fa fa-trash-o" aria-hidden="true"></i> Очистить раздел
                </button>
            </div>
            
            <div class="col-12 text-center">
                <hr>
                <small class="text-secondary">2021 &copy; Давыдов Д.Э., <a href="mailto:davydov@school416spb.ru">davydov@school416spb.ru</a><br>
                версия 1.21.5.26<br>
                <?php
                
                    $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                    echo "Ссылка для министерства: ", $url;
                
                ?>
                </small>
            </div>
            
        </div>
        
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
                      

    <?php
    
      if (isset($_POST['food_clear'])) {
          if (htmlspecialchars($_POST['psswd']) == $del_code){
			if (file_exists('../'.$way.'/'))
				foreach (glob('../'.$way.'/*.xlsx') as $file)
					unlink($file);
			echo '<meta http-equiv="refresh" content="0; url='.$url.'">';
		  }
        }
    
    ?>
    
    
    <div class="modal fade" id="Modal_DEL" tabindex="-1" aria-labelledby="Modal_DEL" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Очистка раздела</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
        <form method="POST">
            <p>Будут удалены все файлы меню в директории food. Вы уверены, что хотите удалить файлы?!</p>
            <p><input type="password" name="psswd" class="form-control" placeholder="Код подтверждения" required="" autocomplete="off"></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-success" data-dismiss="modal"><i class="fa fa-minus-circle" aria-hidden="true"></i> Нет</button>
            <button name="food_clear" type="submit" class="btn btn-outline-danger"><i class="fa fa-plus-circle" aria-hidden="true"></i> Да</button>
        </form>
          </div>
        </div>
      </div>
    </div>
    
    <?php
    
      if (isset($_POST['del_sm'])) {
        if (htmlspecialchars($_POST['psswd']) == $main_code){
			if (file_exists('../'.$way.'/'.$name1))
				foreach (glob('../'.$way.'/'.$name1) as $file)
					unlink($file);
			echo '<meta http-equiv="refresh" content="0; url='.$url.'">';
		}
        }
    
    ?>
    
    <div class="modal fade" id="Modal_sm" tabindex="-1" aria-labelledby="Modal_sm" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Удаление файла</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
        <form method="POST">
            <p>Файл <?php echo '<span class="text-success">',$name1,'</span>'; ?> будет удален. Вы уверены, что хотите удалить файл?!</p>
            <p><input type="password" name="psswd" class="form-control" placeholder="Код подтверждения" required="" autocomplete="off"></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-success" data-dismiss="modal"><i class="fa fa-minus-circle" aria-hidden="true"></i> Нет</button>
            <button name="del_sm" type="submit" class="btn btn-outline-danger"><i class="fa fa-plus-circle" aria-hidden="true"></i> Да</button>
        </form>
          </div>
        </div>
      </div>
    </div>
    
    <?php
    
      if (isset($_POST['del_ss'])) {
        if (htmlspecialchars($_POST['psswd']) == $main_code){
			if (file_exists('../'.$way.'/'.$name2))
				foreach (glob('../'.$way.'/'.$name2) as $file)
					unlink($file);
			echo '<meta http-equiv="refresh" content="0; url='.$url.'">';
		}
        }
    
    ?>
    
    <div class="modal fade" id="Modal_ss" tabindex="-1" aria-labelledby="Modal_ss" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Удаление файла</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
        <form method="POST">
            <p>Файл <?php echo '<span class="text-success">',$name2,'</span>'; ?> будет удален. Вы уверены, что хотите удалить файл?!</p>
            <p><input type="password" name="psswd" class="form-control" placeholder="Код подтверждения" required="" autocomplete="off"></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-success" data-dismiss="modal"><i class="fa fa-minus-circle" aria-hidden="true"></i> Нет</button>
            <button name="del_ss" type="submit" class="btn btn-outline-danger"><i class="fa fa-plus-circle" aria-hidden="true"></i> Да</button>
        </form>
          </div>
        </div>
      </div>
    </div>

</body>
    
</html>
