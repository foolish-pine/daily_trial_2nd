/* ================================================================
  javascript
   ================================================================ */

$(function () {
  // ---------------------------------------------
  // スティッキーヘッダー
  // ---------------------------------------------

  var $window = $(window),
    $header = $(".p-header"),
    threshold = $(".js-sticky-header-threshold").outerHeight();

  $window.on("scroll", function () {
    if ($window.scrollTop() > threshold) {
      $header.addClass("visible");
    } else {
      $header.removeClass("visible");
    }
  });

  // ---------------------------------------------
  // ハンバーガーメニュー
  // ---------------------------------------------
  var $headerNav = $(".js-header-nav"),
    $hamburgerMenu = $(".js-hamburger-menu"),
    $headerCloseButton = $(".js-header-close-button"),
    $navFilter = $(".js-nav-filter"),
    $qandaContainer = $(".js-qanda-container"),
    $qnadaAnswer = $(".js-qnada-answer"),
    $crossMenuLine = $(".js-cross-menu-line");

  var mqPC = window.matchMedia("screen and (max-width:767px)");

  // ウィンドウリサイズ時にヘッダーメニュー閉じる
  $(window).on("resize", function () {
    if (mqPC.matches) {
      // sp, tabサイズのとき
      $headerNav.css({
        right: "-300px",
      });
      $headerCloseButton.fadeOut();
      $navFilter.fadeOut();
    }
  });

  // メニューアイコンをクリックしてnavを開閉する
  var duration = 300;

  $hamburgerMenu.on("click", function () {
    if (mqPC.matches) {
      // sp, tabサイズのとき
      $headerNav.stop(true).animate(
        {
          right: "0",
        },
        duration,
        "swing"
      );
      $headerCloseButton.fadeIn();
      $navFilter.stop(true).fadeIn();
    }
  });

  // ナビの余白クリックでメニュー閉じる
  $headerNav.on("click", function () {
    if (mqPC.matches) {
      // sp, tabサイズのとき
      $headerNav.stop(true).animate(
        {
          right: "-100vw",
        },
        duration,
        "swing"
      );
      $headerCloseButton.fadeOut();
      $navFilter.stop(true).fadeOut();
    }
  });

  // navの外側クリックでnav閉じる
  $navFilter.on("click", function () {
    $headerNav.stop(true).animate(
      {
        right: "-300px",
      },
      duration,
      "swing"
    );
    $headerCloseButton.fadeOut();
    $navFilter.stop(true).fadeOut();
  });

  // Q&Aをクリックで回答を表示する
  $qandaContainer.on("click", function () {
    $(this).find($qnadaAnswer).stop(true).slideToggle();
    $(this).find($crossMenuLine).stop(true).toggleClass("active");
  });

  // ---------------------------------------------
  // スムーススクロール（ページ内リンク）
  // ---------------------------------------------

  $(".js-smoothscroll").click(function () {
    var speed = 500,
      href = $(this).attr("href"),
      target = $(href == "#" || href == "" ? "html" : href),
      headerHeight = $(".p-header").outerHeight(),
      position = target.offset().top - headerHeight; // ヘッダーの高さ分スクロール量を減らす
    $("html, body").animate({ scrollTop: position }, speed);
  });

  // ---------------------------------------------
  // スムーススクロール（トップへ戻る）
  // ---------------------------------------------

  var appear = false,
    pagetop = $(".js-page-top");
  $(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
      //100pxスクロールしたら
      if (appear == false) {
        appear = true;
        pagetop.stop().fadeIn();
      }
    } else {
      if (appear) {
        appear = false;
        pagetop.stop().fadeOut();
      }
    }
  });
  pagetop.click(function () {
    $("body, html").animate({ scrollTop: 0 }, 500);
  });

  // ---------------------------------------------
  // slickスライダー
  // ---------------------------------------------

  $(".p-results__swiper-container").slick({
    autoplay: true,
    autoplaySpeed: 3000,
    dots: true,
    arrows: false,
    variableWidth: true,
  });

  // ---------------------------------------------
  // contactページでのヘッダー調整
  // ---------------------------------------------

  $(window).on("load resize", function () {
    if (document.URL.match("contact/")) {
      if (mqPC.matches) {
        // sp, tabサイズのとき
        $("#contact").css({ paddingTop: 108 });
      } else {
        $header.css({ backgroundColor: "#fff" });
        $("#contact").css({ paddingTop: 160 });
      }
    }
  });
});
