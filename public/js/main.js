/* ================================================================
  javascript
   ================================================================ */

$(function () {
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
  // スクロールフェードイン
  // ---------------------------------------------

  var effectPos = 300, // 画面下からどの位置でフェードさせるか(px)
    effectMove = 50, // どのぐらい要素を動かすか(px)
    effectTime = 2000; // エフェクトの時間(ms) 1秒なら1000

  // フェードする前のcssを定義
  $(".js-scroll-fadein").css({
    opacity: 0,
    transform: `translateY(${effectMove}px)`,
  });

  // スクロールまたはロードするたびに実行
  $(window).on("scroll load", function () {
    var scrollBtm = $(this).scrollTop() + $(this).height(),
      threshold = scrollBtm - effectPos;

    // 要素が可視範囲に入ったとき、エフェクトが発動
    $(".js-scroll-fadein").each(function () {
      var thisPos = $(this).offset().top;
      if (threshold > thisPos) {
        $(this).css({
          opacity: 1,
          transform: "translateY(0)",
          transition: `opacity ${effectTime}ms, transform ${effectTime}ms`,
        });
      }
    });
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
});
