<!-- コンタクトフォーム用PHPここから -->
<?php
session_start();

// クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');
$clean = array();
$error = array();

// トークン生成
if (!isset($_SESSION['token'])) {
  $_SESSION['token'] = sha1(random_bytes(30));
}

// サニタイズ
if(!empty($_POST)) {
  foreach($_POST as $key => $value) {
    $clean[$key] = htmlspecialchars($value, ENT_QUOTES,'UTF-8');
  }
}

// 前後にある半角全角スペースを削除する関数
function spaceTrim ($str) {
  // 行頭
  $str = preg_replace('/^[ 　]+/u', '', $str);
  // 末尾
  $str = preg_replace('/[ 　]+$/u', '', $str);
  return $str;
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
  <link rel="apple-touch-icon" sizes="180x180" href="./img/favicon/apple-touch-icon.png" />
  <link rel="icon" href="./img/favicon/favicon.ico" />
  <!-- CSS -->
  <link rel="stylesheet" href="./css/style.css" />
  <link rel="stylesheet" href="./css/plugin/slick-theme.css" type="text/css">
  <link rel="stylesheet" href="./css/plugin/slick.css" />
</head>

<body>
  <!-- ヘッダーここから -->
  <header class="l-header">
    <div class="p-header">
      <div class="p-header__logo">
        <a href="#">
          <h1>
            <img src="./img/logo@2x.png" alt="HANIWAMAN Corp.">
          </h1>
        </a>
      </div>
      <button class="p-header__menu">
        <img src="./img/svg/hamburger.svg" alt="">
      </button>
      <nav class="p-header__nav">
        <ul class="p-header__list">
          <li class="p-header__item"><a class="js-smoothscroll" href="#news">News</a></li>
          <li class="p-header__item"><a class="js-smoothscroll" href="#service">Service</a></li>
          <li class="p-header__item"><a class="js-smoothscroll" href="#results">Results</a></li>
          <li class="p-header__item"><a class="js-smoothscroll" href="#faqs">FAQs</a></li>
          <li class="p-header__item"><a class="js-smoothscroll" href="#price">Price</a></li>
          <li class="p-header__item"><a class="js-smoothscroll" href="#comments">Comments</a></li>
          <li class="p-header__item"><a class="js-smoothscroll" href="#contact">Contact</a></li>
        </ul>
      </nav>
    </div>
  </header>
  <!-- ヘッダーここまで -->
  <!-- メインここから -->
  <main class="l-main">
    <!-- メインビジュアルここから -->
    <div class="p-main-visual">
      <div class="p-main-visual__inner">
        <p class="p-main-visual__catch-main">
          詩が生れて、画が出来る。
          <br>
          とかくに人の世は住みにくい。
        </p>
        <p class="p-main-visual__catch-sub">
          どこへ越しても住みにくいと悟った時、詩が生れて、画が出来る。意地を通せば窮屈だ。
        </p>
        <div class="p-main-visual__contact-button c-button--contact">
          <a class="js-smoothscroll" href="#contact">
            お問い合わせしてみる
          </a>
        </div>
      </div>
    </div>
    <!-- メインビジュアルここから -->
    <!-- newsコンテンツここから -->
    <div id="news" class="p-news">
      <div class="p-news__container">
        <h2 class="p-news__section-title c-text__section-title">
          News
        </h2>
        <a class="p-news__content-link" href="#">
          <div class="p-news__content">
            <div class="p-news__content-time-icon">
              <time datetime="2019-02-01">
                2019-02-01
              </time>
              <span class="p-news__content-icon-1">
                テキスト
              </span>
            </div>
            <p class="p-news__content-text c-text">
              ニュースニュースニュースニュースニュースニュースニュースニュースニュースニュースニュースニュースニュースニュース
            </p>
          </div>
        </a>
        <a class="p-news__content-link" href="#">
          <div class="p-news__content">
            <div class="p-news__content-time-icon">
              <time datetime="2019-02-01">
                2019-02-01
              </time>
              <span class="p-news__content-icon-1">
                テキスト
              </span>
            </div>
            <p class="p-news__content-text c-text">
              ニュースニュースニュースニュースニュースニュースニュースニュースニュースニュースニュースニュースニュースニュース
            </p>
          </div>
        </a>
        <a class="p-news__content-link" href="#">
          <div class="p-news__content">
            <div class="p-news__content-time-icon">
              <time datetime="2019-02-01">
                2019-02-01
              </time>
              <span class="p-news__content-icon-1">
                テキスト
              </span>
            </div>
            <p class="p-news__content-text c-text">
              ニュースニュースニュースニュースニュースニュースニュースニュースニュースニュースニュースニュースニュースニュース
            </p>
          </div>
        </a>
        <div class="p-news__button c-button--default">
          <a href="#">
            MORE
          </a>
        </div>
      </div>
    </div>
    <!-- newsコンテンツここまで -->
    <!-- serviceコンテンツここから -->
    <div id="service" class="p-service">
      <div class="p-service__inner">
        <h2 class="p-service__section-title c-text__section-title">
          Service
        </h2>
        <div class="p-service__container">
          <div class="p-service__content">
            <div class="p-service__content-image">
              <img src="img/svg/service1.svg" alt="">
            </div>
            <p class="p-service__content-title">
              WEB<br>
              DESIGN
            </p>
            <p class="p-service__content-text c-text">
              どこへ越しても住みにくいと悟った時、詩が生れて、画が出来る。意地を通せば窮屈だ。
            </p>
          </div>
          <div class="p-service__content">
            <div class="p-service__content-image">
              <img src="img/svg/service2.svg" alt="">
            </div>
            <p class="p-service__content-title">
              WEB<br>
              CODING
            </p>
            <p class="p-service__content-text c-text">
              どこへ越しても住みにくいと悟った時、詩が生れて、画が出来る。意地を通せば窮屈だ。
            </p>
          </div>
          <div class="p-service__content">
            <div class="p-service__content-image">
              <img src="img/svg/service3.svg" alt="">
            </div>
            <p class="p-service__content-title">
              CMS<br>
              CUSTOMIZE
            </p>
            <p class="p-service__content-text c-text">
              どこへ越しても住みにくいと悟った時、詩が生れて、画が出来る。意地を通せば窮屈だ。
            </p>
          </div>
        </div>
      </div>
    </div>
    <!-- serviceコンテンツここまで -->
    <!-- resultsコンテンツここから -->
    <div id="results" class="p-results">
      <h2 class="p-results__section-title c-text__section-title">
        Results
      </h2>
      <div class="p-results__inner">
        <div class="p-results__swiper-container">
          <div class="p-results__swiper-content">
            <img src="img/slide1@2x.png" alt="">
            <div class="p-results__swiper-text-container">
              <p class="p-results__swiper-title">
                とかくに人の世は住みにくい。
              </p>
              <p class="p-results__swiper-text">
                どこへ越しても住みにくいと悟った時、詩が生れて、画が出来る。意地を通せば窮屈だ。
              </p>
            </div>
          </div>
          <div class="p-results__swiper-content">
            <img src="img/slide1@2x.png" alt="">
            <div class="p-results__swiper-text-container">
              <p class="p-results__swiper-title">
                とかくに人の世は住みにくい。
              </p>
              <p class="p-results__swiper-text">
                どこへ越しても住みにくいと悟った時、詩が生れて、画が出来る。意地を通せば窮屈だ。
              </p>
            </div>
          </div>
          <div class="p-results__swiper-content">
            <img src="img/slide1@2x.png" alt="">
            <div class="p-results__swiper-text-container">
              <p class="p-results__swiper-title">
                とかくに人の世は住みにくい。
              </p>
              <p class="p-results__swiper-text">
                どこへ越しても住みにくいと悟った時、詩が生れて、画が出来る。意地を通せば窮屈だ。
              </p>
            </div>
          </div>
          <div class="p-results__swiper-content">
            <img src="img/slide1@2x.png" alt="">
            <div class="p-results__swiper-text-container">
              <p class="p-results__swiper-title">
                とかくに人の世は住みにくい。
              </p>
              <p class="p-results__swiper-text">
                どこへ越しても住みにくいと悟った時、詩が生れて、画が出来る。意地を通せば窮屈だ。
              </p>
            </div>
          </div>
          <div class="p-results__swiper-content">
            <img src="img/slide1@2x.png" alt="">
            <div class="p-results__swiper-text-container">
              <p class="p-results__swiper-title">
                とかくに人の世は住みにくい。
              </p>
              <p class="p-results__swiper-text">
                どこへ越しても住みにくいと悟った時、詩が生れて、画が出来る。意地を通せば窮屈だ。
              </p>
            </div>
          </div>
          <div class="p-results__swiper-content">
            <img src="img/slide1@2x.png" alt="">
            <div class="p-results__swiper-text-container">
              <p class="p-results__swiper-title">
                とかくに人の世は住みにくい。
              </p>
              <p class="p-results__swiper-text">
                どこへ越しても住みにくいと悟った時、詩が生れて、画が出来る。意地を通せば窮屈だ。
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="p-results__button c-button--default">
        <a href="#">
          VIEW ALL
        </a>
      </div>
    </div>
    </div>
    <!-- resultsコンテンツここまで -->
    <!-- priceコンテンツここから -->
    <div id="price" class="p-price">
      <h2 class="p-price__section-title c-text__section-title">
        Price
      </h2>
      <table class="p-price__table">
        <tbody>
          <tr class="p-price__table-row">
            <th class="p-price__table-header">
              row1
            </th>
            <td class="p-price__table-data">
              Price ￥10,000
            </td>
          </tr>
        </tbody>
        <tbody>
          <tr class="p-price__table-row">
            <th class="p-price__table-header">
              row2
            </th>
            <td class="p-price__table-data">
              Price ￥10,000
            </td>
          </tr>
        </tbody>
        <tbody>
          <tr class="p-price__table-row">
            <th class="p-price__table-header">
              row3
            </th>
            <td class="p-price__table-data">
              Price ￥10,000
            </td>
          </tr>
        </tbody>
      </table>
      <p class="p-price__notice">
        ※ 上記料金はサンプルです。
      </p>
    </div>
    <!-- priceコンテンツここまで -->
    <!-- commentsコンテンツここから -->
    <div id="comments" class="p-comments">
      <div class="p-comments__container">
        <h2 class="p-comments__section-title c-text__section-title">
          Comments
        </h2>
        <div class="p-comments__content">
          <div class="p-comments__content-image">
            <img src="img/comments1@2x.png" alt="">
          </div>
          <p class="p-comments__content-text">
            どこへ越しても住みにくいと悟った時、詩が生れて、画が出来る。意地を通せば窮屈だ。どこへ越しても住みにくいと悟った時、詩が生れて、画が出来る。意地を通せば窮屈だ。
          </p>
        </div>
        <div class="p-comments__content">
          <div class="p-comments__content-image">
            <img src="img/comments2@2x.png" alt="">
          </div>
          <p class="p-comments__content-text">
            どこへ越しても住みにくいと悟った時、詩が生れて、画が出来る。意地を通せば窮屈だ。どこへ越しても住みにくいと悟った時、詩が生れて、画が出来る。意地を通せば窮屈だ。
          </p>
        </div>
      </div>
    </div>
    <div id="qanda" class="p-qanda">
      <h2 class="p-qanda__section-title c-text__section-title">
        Q&A
      </h2>
      <div class="p-qanda__container">
        <div class="p-qanda__content-question-container">
          <span class="p-qanda__content-question-mark">
            Q
          </span>
          <p class="p-qanda__content-question-text c-text">
            質問質問質問？
          </p>
          <button>
            <span class="p-qanda__content-question-toggle-line"></span>
            <span class="p-qanda__content-question-toggle-line"></span>
          </button>
        </div>
        <p class="p-qanda__content-answer-text c-text">
          回答回答回答回答回答回答回答回答回答回答回答回答回答回答回答回答回答回答回答回答回答回答
        </p>
      </div>
      <div class="p-qanda__container">
        <div class="p-qanda__content-question-container">
          <span class="p-qanda__content-question-mark">
            Q
          </span>
          <p class="p-qanda__content-question-text c-text">
            質問質問質問？<br>
            また、質問は質問質問？
          </p>
          <button>
            <span class="p-qanda__content-question-toggle-line"></span>
            <span class="p-qanda__content-question-toggle-line"></span>
          </button>
        </div>
        <p class="p-qanda__content-answer-text">
          回答回答回答回答回答回答回答回答回答回答回答回答
        </p>
      </div>
      <div class="p-qanda__container">
        <div class="p-qanda__content-question-container">
          <span class="p-qanda__content-question-mark">
            Q
          </span>
          <p class="p-qanda__content-question-text c-text">
            質問質問質問？
          </p>
          <button>
            <span class="p-qanda__content-question-toggle-line"></span>
            <span class="p-qanda__content-question-toggle-line"></span>
          </button>
        </div>
        <p class="p-qanda__content-answer-text">
          回答回答回答回答回答回答回答回答回答回答回答回答回答回答回答回答回答回答回答回答回答回答
        </p>
      </div>
      <div class="p-qanda__container">
        <div class="p-qanda__content-question-container">
          <span class="p-qanda__content-question-mark">
            Q
          </span>
          <p class="p-qanda__content-question-text c-text">
            質問質問質問？
          </p>
          <button>
            <span class="p-qanda__content-question-toggle-line"></span>
            <span class="p-qanda__content-question-toggle-line"></span>
          </button>
        </div>
        <p class="p-qanda__content-answer-text">
          回答回答回答回答回答回答回答回答回答回答回答回答回答回答回答回答回答回答回答回答回答回答
        </p>
      </div>
      <div class="p-qanda__container">
        <div class="p-qanda__content-question-container">
          <span class="p-qanda__content-question-mark">
            Q
          </span>
          <p class="p-qanda__content-question-text c-text">
            質問質問質問？
          </p>
          <button>
            <span class="p-qanda__content-question-toggle-line"></span>
            <span class="p-qanda__content-question-toggle-line"></span>
          </button>
        </div>
        <p class="p-qanda__content-answer-text">
          回答回答回答回答回答回答回答回答回答回答回答回答回答回答回答回答回答回答回答回答回答回答
        </p>
      </div>
      <div class="p-qanda__container">
        <div class="p-qanda__content-question-container">
          <span class="p-qanda__content-question-mark">
            Q
          </span>
          <p class="p-qanda__content-question-text c-text">
            質問質問質問？
          </p>
          <button>
            <span class="p-qanda__content-question-toggle-line"></span>
            <span class="p-qanda__content-question-toggle-line"></span>
          </button>
        </div>
        <p class="p-qanda__content-answer-text">
          回答回答回答回答回答回答回答回答回答回答回答回答回答回答回答回答回答回答回答回答回答回答
        </p>
      </div>
    </div>
    <div id="access" class="p-access">
      <div class="p-access__inner">
        <h2 class="p-access__section-title c-text__section-title">
          Access
        </h2>
        <p class="p-access__address">
          〒106-6126<br>
          東京都港区六本木 6丁目 10-1<br>
          六本木ヒルズ森タワー
        </p>
        <div class="p-access__google-map">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3241.670815803256!2d139.72727301460444!3d35.66048118871842!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60188b828453ffff%3A0xb8603beeb9b150d8!2z5YWt5pys5pyo44OS44Or44K65qOu44K_44Ov44O8!5e0!3m2!1sja!2sjp!4v1587858784728!5m2!1sja!2sjp" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0">
          </iframe>
        </div>
        <div class="p-access__button c-button--default">
          <a href="#">
            Google Maps
          </a>
        </div>
      </div>
    </div>
    <div id="contact" class="p-contact">
      <div class="p-contact__container">
        <div class="p-contact__text-container">
          <h2 class="p-contact__section-title c-text__section-title">
            Contact Us
          </h2>
          <p class="p-contact__text">
            どこへ越しても住みにくいと悟った時、詩が生れて、画が出来る。
          </p>
        </div>
        <?php if (!empty($error)): ?>
        <ul class="p-contact__error-list">
          <?php foreach ($error as $value): ?>
          <li><?php echo $value; ?></li>
          <?php endforeach; ?>
        </ul>
        <?php endif; ?>
        <div class="p-contact__inner">
          <form action="" method="post">
            <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
            <div class="p-contact__request">
              <p class="p-contact__label">
                お問い合わせ種別
                <span class="p-contact__label-required">必須</span>
              </p>
              <div class="p-contact__select-container">
                <select class="p-contact__label" name="お問い合わせ種別">
                  <option value="">選択してください</option>
                  <option value="ご質問・お問い合わせ">ご質問・お問い合わせ</option>
                </select>
              </div>
            </div>
            <div class="p-contact__name">
              <label for="name" class="p-contact__label">
                氏名
                <span class="p-contact__label-required">必須</span>
              </label>
              <input class="p-contact__textbox" type="text" id="name" name="name" placeholder="氏名" value="<?php if( !empty($clean['name']) ){ echo $clean['name']; } ?>" required />
            </div>
            <div class="p-contact__furigana">
              <label for="furigana" class="p-contact__label">
                フリガナ
                <span class="p-contact__label-required">必須</span>
              </label>
              <input class="p-contact__textbox" type="text" id="furigana" name="furigana" placeholder="フリガナ" value="<?php if( !empty($clean['furigana']) ){ echo $clean['furigana']; } ?>" required />
            </div>
            <div class="p-contact__email">
              <label for="email" class="p-contact__label">
                メールアドレス
                <span class="p-contact__label-required">必須</span>
              </label>
              <input class="p-contact__textbox" type="text" id="email" name="email" placeholder="sample@gmail.com" value="<?php if( !empty($clean['email']) ){ echo $clean['email']; } ?>" required />
            </div>
            <div class="p-contact__sex">
              <label for="sex" class="p-contact__label">
                性別
              </label>
              <div class="p-contact-radio-button-container">
                <label class="p-contact__radio-label">
                  <input class="p-contact__radio" type="radio" id="male" name="sex" value="<?php if( !empty($clean['male']) ){ echo $clean['male']; } ?>" /> 男性
                </label>
                <label class="p-contact__radio-label">
                  <input class="p-contact__radio" type="radio" id="female" name="sex" value="<?php if( !empty($clean['female']) ){ echo $clean['female']; } ?>" /> 女性
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
              <label class="c-text" for="agree">
                <input type="checkbox" id="agree" name="agree" value="agree" <?php if (!empty($clean['agree'])) {echo 'checked';} ?> required /> 個人情報保護方針に同意する
              </label>
            </div>
            <div class="p-contact__button c-button--contact">
              <input type="submit" name="confirmation" value="送信する">
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>
  <!-- メインここから -->

  <!-- フッターここから -->
  <footer class="l-footer">
    <div class="p-footer">
      <div class="p-footer__inner">
        <div class="p-footer__icon-container">
          <a href="#">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="#">
            <i class="fab fa-facebook"></i>
          </a>
        </div>
        <div class="p-footer__link-container">
          <a href="#">サイトマップ</a>
          <a href="#">個人情報保護方針</a>
          <a href="#">プライバシーポリシー</a>
        </div>
        <a href="#" class="p-footer__logo">
          HANIWAMAN Corp.
        </a>
        <p class="p-footer__copyright">© Haniwaman Landing page Sample.</p>
      </div>
    </div>
  </footer>
  <!-- フッターここまで -->
  <!-- jQuery -->
  <script src="./js/jQuery/jquery-3.5.0.min.js"></script>
  <script src="./js/plugin/slick.min.js"></script>
  <script src="./js/main.js"></script>
</body>

</html>