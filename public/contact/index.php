<!-- コンタクトフォーム用PHPここから -->
<?php
session_start();

// クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');

$page_flag = 0;
$clean = array();

// サニタイズ
function sanitize($input) {
  foreach ($input as $key => $value) {
    if (is_array($value)) {
      $_input[$key] = sanitize($value);
    } else {
      $_input[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
  }
  return $_input;
}

$POST = $_POST;
if (!empty($POST)) {
  $clean = sanitize($POST);
}

$question= null;
$reqruit= null;
$IR= null;

$male= null;
$female= null;

if (!empty($clean['request']) && $clean['request'] === 'ご質問・お問い合わせ') {
  $question = $clean['request'];}

if (!empty($clean['request']) && $clean['request'] === '採用') {
  $reqruit = $clean['request'];}

if (!empty($clean['request']) && $clean['request'] === 'IR') {
  $IR = $clean['request'];}

if (!empty($clean['sex']) && $clean['sex'] === '男性') {
  $male = $clean['sex'];}

if (!empty($clean['request']) && $clean['request'] === '女性') {
  $female = $clean['sex'];}

// 前後にある半角全角スペースを削除する関数
function spaceTrim($str)
{
  // 行頭
  $str = preg_replace('/^[ 　]+/u', '', $str);
  // 末尾
  $str = preg_replace('/[ 　]+$/u', '', $str);
  return $str;
}

// トークン生成
if (!isset($_SESSION['token'])) {
  $_SESSION['token'] = sha1(random_bytes(30));
}

if (!empty($clean['back'])) {
  $page_flag = 0;
  
  // トークンを確認し、確認画面を表示
  if (!(hash_equals($_POST['token'], $_SESSION['token']))) {
    echo "不正アクセスの可能性があります";
    exit();
  }

} elseif (!empty($clean['confirmation'])) {

  if (!(hash_equals($_POST['token'], $_SESSION['token']))) {
    echo "不正アクセスの可能性があります";
    exit();
  }

  $error = validation($clean);

  if (empty($error)) {
    $page_flag = 1;

    // セッションの書き込み
    $_SESSION['page'] = true;
  } else {
    $page_flag = 0;
  }

} elseif (!empty($clean['submit'])) {

  if (!(hash_equals($_POST['token'], $_SESSION['token']))) {
    echo "不正アクセスの可能性があります";
    exit();
  }

  if (!empty($_SESSION['page']) && $_SESSION['page'] === true) {

    // セッションの削除
    unset($_SESSION['page']);

    $page_flag = 2;

    $auto_reply_subject = null;
    $auto_reply_text = null;
    $admin_reply_subject = null;
    $admin_reply_text = null;
    date_default_timezone_set('Asia/Tokyo');

    $header = "MIME-Version: 1.0\n";
    $header .= "From: Daily Trial 2nd <noreply@test.com>\n";
    $header .= "Reply-To: Daily Trial 2nd <noreply@test.com>\n";

    $auto_reply_subject = 'お問い合わせありがとうございます。';

    $auto_reply_text = "※※※このメールはテストメールです※※※\n\n";
    $auto_reply_text .= "この度は、お問い合わせいただきありがとうございます。\n下記の内容でお問い合わせを受け付けました。\n\n";
    $auto_reply_text .= "お問い合わせ日時：" . date("Y-m-d H:i") . "\n";
    $auto_reply_text .= "お問い合わせ内容：" . $clean['request'] . "\n";
    $auto_reply_text .= "お名前：" . $clean['name'] . "\n";
    $auto_reply_text .= "メールアドレス：" . $clean['email'] . "\n";
    $auto_reply_text .= "性別：" . $clean['sex'] . "\n";
    $auto_reply_text .= "メッセージ：\n" . $clean['message'] . "\n\n";
    $auto_reply_text .= "このメールは以下のサイトのお問い合わせフォームから送信されました。\nhttps://daily-tria-2nd.foolish-pine.com";

    // 利用者へメール送信
    mb_send_mail($clean['email'], $auto_reply_subject, $auto_reply_text, $header);

    $admin_reply_subject = "お問い合わせ受け付けました";

    $admin_reply_text = "※※※このメールはテストメールです※※※\n\n";
    $admin_reply_text .= "下記の内容でお問い合わせがありました。\n\n";
    $admin_reply_text .= "お問い合わせ日時：" . date("Y-m-d H:i") . "\n";
    $admin_reply_text .= "お問い合わせ内容：" . $clean['request'] . "\n";
    $admin_reply_text .= "お名前：" . $clean['name'] . "\n";
    $admin_reply_text .= "メールアドレス：" . $clean['email'] . "\n";
    $admin_reply_text .= "性別：" . $clean['sex'] . "\n";
    $admin_reply_text .= "メッセージ：\n" . $clean['message'] . "\n\n";
    $admin_reply_text .= "このメールは以下のサイトのお問い合わせフォームから送信されました。\nhttps://daily-tria-2nd.foolish-pine.com";

    // 管理者へメール送信
    mb_send_mail($clean['email'], $admin_reply_subject, $admin_reply_text, $header);
  } else {
    $page_flag = 0;
  }
}

function validation($data)
{
  $error = array();

  // お問い合わせ種別のバリデーション
  if ($data['request'] === "選択してください") {
    $error[] = "お問い合わせ種別を選択してください";
  }

  // 氏名のバリデーション
  if (20 < mb_strlen($data['name'])) {
    $error[] = "「氏名」は20文字以内で入力してください。";
  }

  // フリガナのバリデーション
  if (20 < mb_strlen($data['furigana'])) {
    $error[] = "「フリガナ」は20文字以内で入力してください。";
  }

  if (! (preg_match("/^[ァ-ヶー]+$/u", $data['furigana']))) {
    $error[] = "「フリガナ」は全角カタカナで入力してください。";
  }
  
  // メールアドレスのバリデーション
  if (!preg_match('/^[0-9a-z_.\/?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$/', $data['email'])) {
    $error[] = "「メールアドレス」は正しい形式で入力してください。";
  }

  return $error;
}

?>
<!-- コンタクトフォーム用PHPここまで -->






<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>デイトラ2ndコーディング課題</title>
  <meta name="description" content="" />
  <!-- 検索結果から除外する -->
  <meta name="robots" content="none" />
  <!-- favicon -->
  <link rel="apple-touch-icon" sizes="180x180" href="../img/favicon/apple-touch-icon.png" />
  <link rel="icon" href="../img/favicon/favicon.ico" />
  <!-- CSS -->
  <link rel="stylesheet" href="../css/style.css" />
  <link rel="stylesheet" href="../css/plugin/slick.css" />
  <link rel="stylesheet" href="../css/plugin/slick-theme.css" type="text/css">
</head>

<body>
  <!-- ヘッダーここから -->
  <header class="l-header">
    <div class="p-header">
      <div class="p-header__logo">
        <a href="..">
          <h1>
            <img src="../img/logo@2x.png" alt="HANIWAMAN Corp.">
          </h1>
        </a>
      </div>
      <button class="p-header__hamburger-menu js-hamburger-menu">
        <img src="../img/svg/hamburger.svg" alt="">
      </button>
      <span class="p-header__nav-filter js-nav-filter"></span>
      <nav class="p-header__nav js-header-nav">
        <button class="p-header__close-button js-header-close-button">
          <img src="../img/svg/batsu.svg" alt="">
        </button>
        <ul class="p-header__list">
          <li class="p-header__item"><a class="js-smoothscroll" href="..#news">News</a></li>
          <li class="p-header__item"><a class="js-smoothscroll" href="..#service">Service</a></li>
          <li class="p-header__item"><a class="js-smoothscroll" href="..#results">Results</a></li>
          <li class="p-header__item"><a class="js-smoothscroll" href="..#price">Price</a></li>
          <li class="p-header__item"><a class="js-smoothscroll" href="..#comments">Comments</a></li>
          <li class="p-header__item"><a class="js-smoothscroll" href="..#qanda">FAQs</a></li>
          <li class="p-header__item"><a class="js-smoothscroll" href="..#contact">Contact</a></li>
        </ul>
      </nav>
    </div>
  </header>
  <!-- ヘッダーここまで -->
  <!-- メインここから -->
  <main class="l-main">
    <div id="contact" class="p-contact">
      <div class="p-contact__container">
        <div class="p-contact__text-container">
          <h2 class="p-contact__section-title c-text__section-title">
            Contact Us
          </h2>
          <p class="p-contact__text c-text">
            どこへ越しても住みにくいと悟った時、詩が生れて、画が出来る。
          </p>
        </div>
        <!-- お問い合わせフォーム入力ページここから -->
        <?php if ($page_flag === 0) : ?>
        <form class="p-contact__form" action="" method="post">
          <?php if (!empty($error)): ?>
          <ul class="p-contact__error-list">
            <?php foreach ($error as $value): ?>
            <li><?php echo $value; ?></li>
            <?php endforeach; ?>
          </ul>
          <?php endif; ?>
          <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
          <div class="p-contact__form-parts-container">
            <p class="p-contact__label">
              お問い合わせ種別
              <span class="p-contact__label-required">必須</span>
            </p>
            <div class="p-contact__select-container">
              <select name="request">
                <option value="選択してください">選択してください</option>
                <option value="ご質問・お問い合わせ" <?php if (!empty($question)) {echo 'selected';} ?>>ご質問・お問い合わせ</option>
                <option value="採用" <?php if (!empty($reqruit)) {echo 'selected';} ?>>採用</option>
                <option value="IR" <?php if (!empty($IR)) {echo 'selected';} ?>>IR</option>
              </select>
            </div>
          </div>
          <div class="p-contact__form-parts-container">
            <label for="name" class="p-contact__label">
              氏名
              <span class="p-contact__label-required">必須</span>
            </label>
            <input class="p-contact__textbox" type="text" id="name" name="name" placeholder="氏名" value="<?php if( !empty($clean['name']) ){ echo $clean['name']; } ?>" required />
          </div>
          <div class="p-contact__form-parts-container">
            <label for="furigana" class="p-contact__label">
              フリガナ
              <span class="p-contact__label-required">必須</span>
            </label>
            <input class="p-contact__textbox" type="text" id="furigana" name="furigana" placeholder="フリガナ" value="<?php if( !empty($clean['furigana']) ){ echo $clean['furigana']; } ?>" required />
          </div>
          <div class="p-contact__form-parts-container">
            <label for="email" class="p-contact__label">
              メールアドレス
              <span class="p-contact__label-required">必須</span>
            </label>
            <input class="p-contact__textbox" type="text" id="email" name="email" placeholder="sample@gmail.com" value="<?php if( !empty($clean['email']) ){ echo $clean['email']; } ?>" required />
          </div>
          <div class="p-contact__form-parts-container">
            <label for="sex" class="p-contact__label p-contact__label--sex">
              性別
            </label>
            <div class="p-contact-radio-button-container">
              <label class="p-contact__radio-label">
                <input class="p-contact__radio" type="radio" id="male" name="sex" value="男性" <?php if (!empty($male)) {echo 'checked';} ?> /> 男性
              </label>
              <label class="p-contact__radio-label">
                <input class="p-contact__radio" type="radio" id="female" name="sex" value="女性" <?php if (!empty($female)) {echo 'checked';} ?> /> 女性
              </label>
            </div>
          </div>
          <div class="p-contact__message">
            <label for="message" class="p-contact__label">
              メッセージ
              <span class="p-contact__label-required">必須</span>
            </label>
            <textarea id="message" name="message" required><?php if( !empty($clean['message']) ){ echo $clean['message']; } ?></textarea>
          </div>
          <div class="p-contact__agree">
            <label class="p-contact__agree-text" for="agree">
              <input type="checkbox" id="agree" name="agree" value="agree" <?php if (!empty($clean['agree'])) {echo 'checked';} ?> required /> 個人情報保護方針に同意する
            </label>
          </div>
          <div class="p-contact__button c-button--contact">
            <input type="submit" name="confirmation" value="確認画面へ">
          </div>
        </form>
        <!-- お問い合わせフォーム入力ページここまで -->
        <!-- お問い合わせフォーム確認ページここから -->
        <?php elseif ($page_flag === 1) : ?>
        <form class="p-contact__form" action="" method="post">
          <p class="p-contact__text--confirmation c-text">
            以下の内容で送信します。よろしいですか？<br>※利用者宛と管理者宛のメールが入力されたメールアドレスに送信されます。</p>
          <div class="p-contact__form-parts-container">
            <p class="p-contact__label">
              お問い合わせ種別
            </p>
            <?php
              echo '<div class="p-contact__select--confirmation">' . $clean['request'] . '</div>'; 
            ?>
          </div>
          <div class="p-contact__form-parts-container">
            <label for="name" class="p-contact__label">
              氏名
            </label>
            <?php if (isset($clean['name'])) {
            echo '<div class="p-contact__textbox--confirmation">' . $clean['name'] . '</div>';
          } ?>
          </div>
          <div class="p-contact__form-parts-container">
            <label for="furigana" class="p-contact__label">
              フリガナ
            </label>
            <?php if (isset($clean['furigana'])) {
            echo '<div class="p-contact__textbox--confirmation">' . $clean['furigana'] . '</div>';
          } ?>
          </div>
          <div class="p-contact__form-parts-container">
            <label for="email" class="p-contact__label">
              メールアドレス
            </label>
            <?php if (isset($clean['email'])) {
            echo '<div class="p-contact__textbox--confirmation">' . $clean['email'] . '</div>';
          } ?>
          </div>
          <div class="p-contact__form-parts-container">
            <label for="sex" class="p-contact__label">
              性別
            </label>
            <?php if (isset($clean['sex'])) {
            echo '<div class="p-contact__select--confirmation">' . $clean['sex'] . '</div>';
          } ?>
          </div>
          <div class="p-contact__message">
            <label class="p-contact__label" for=" message">
              メッセージ
            </label>
            <?php if (isset($clean['message'])) {
              echo '<div class="p-contact__textarea--confirmation">' . nl2br($clean['message']) . '</div>';
            } ?>
          </div>
          <div class="p-contact__agree">
            <p class=" p-contact__agree-text p-contact__agree-text--comfirmation">個人情報の取り扱いについて同意のうえ送信します。</p>
          </div>
          <div class="p-contact__button-container">
            <div class="p-contact__button p-contact__button--confirmation c-button--back">
              <input type="submit" name="back" value="戻る">
            </div>
            <div class="p-contact__button p-contact__button--confirmation  c-button--contact">
              <input type="submit" name="submit" value="送信">
            </div>
          </div>
          <input type="hidden" name="token" value="<?php $token = $_SESSION['token']; echo $token?>">
          <input type="hidden" name="request" value="<?php echo $clean['request']; ?>">
          <input type="hidden" name="name" value="<?php echo $clean['name']; ?>">
          <input type="hidden" name="furigana" value="<?php echo $clean['furigana']; ?>">
          <input type="hidden" name="email" value="<?php echo $clean['email']; ?>">
          <input type="hidden" name="sex" value="<?php echo $clean['sex']; ?>">
          <input type="hidden" name="message" value="<?php echo $clean['message']; ?>">
          <input type="hidden" name="agree" value="<?php echo $clean['agree']; ?>">
        </form>
        <!-- お問い合わせフォーム確認ページここまで -->
        <!-- お問い合わせフォーム完了ページここから -->
        <?php elseif ($page_flag === 2) : ?>
        <div class="p-contact__form">
          <p class="p-contact__text--submit c-text">
            送信が完了しました。
          </p>
          <div class="p-contact__button--top c-button--back">
            <a href="..">トップへ戻る</a>
          </div>
        </div>
        <?php endif; ?>
        <!-- お問い合わせフォーム完了ページここまで -->
      </div>
    </div>
  </main>
  <!-- メインここから -->

  <!-- フッターここから -->
  <footer class="l-footer">
    <div class="page-top js-page-top"><a href=".."></a></div>
    <div class="p-footer">
      <div class="p-footer__inner">
        <div class="p-footer__left-column">
          <div class="p-footer__icon-container">
            <a href="..">
              <i class="fab fa-twitter p-footer__sns-icon"></i>
            </a>
            <a href="..">
              <i class="fab fa-facebook p-footer__sns-icon"></i>
            </a>
          </div>
          <div class="p-footer__link-container">
            <a href="..">サイトマップ</a>
            <a href="..">個人情報保護方針</a>
            <a href="..">プライバシーポリシー</a>
          </div>
        </div>
        <div class="p-footer__right-column">
          <div class="p-footer__logo-container">
            <a href=".." class="p-footer__logo">
              HANIWAMAN Corp.
            </a>
            <p class="p-footer__copyright">
              © Haniwaman Landing page Sample.
            </p>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- フッターここまで -->
  <!-- jQuery -->
  <script src="../js/jQuery/jquery-3.5.0.min.js"></script>
  <script src="../js/plugin/slick.min.js"></script>
  <script src="../js/main.js"></script>
</body>

</html>