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
  var $headerNav = $(".p-header__nav"),
    $hamburgerMenu = $(".js-hamburger-menu"),
    $hamburgerMenuLine = $(".js-hamburger-menu-line");

  var mqPC = window.matchMedia("screen and (max-width:1439px)");

  // ウィンドウリサイズ時
  $(window).on("resize", function () {
    $headerNav.removeClass("open");
    $hamburgerMenuLine.stop(true).removeClass("active");
    $(".p-header__nav-filter").fadeOut();
    if (mqPC.matches) {
      // sp, tabサイズのとき
      $headerNav.css({
        right: "-100vw",
      });
    } else {
      $headerNav.css({
        right: "-590px",
      });
    }
  });

  // メニューアイコンをクリックしてnavを開閉する
  var duration = 300;

  $hamburgerMenu.on("click", function () {
    $hamburgerMenuLine.stop(true).toggleClass("active");
    $headerNav.toggleClass("open");
    if (mqPC.matches) {
      // sp, tabサイズのとき
      if ($headerNav.hasClass("open")) {
        $headerNav.stop(true).animate(
          {
            right: "0",
          },
          duration,
          "swing"
        );
      } else {
        $headerNav.stop(true).animate(
          {
            right: "-100vw",
          },
          duration,
          "swing"
        );
      }
    } else {
      // PCサイズのとき
      if ($headerNav.hasClass("open")) {
        $headerNav.stop(true).animate(
          {
            right: "0",
          },
          duration,
          "swing"
        );
        $(".p-header__nav-filter").addClass("active");
        $(".p-header__nav-filter").fadeIn();
      } else {
        $headerNav.stop(true).animate(
          {
            right: "-590px",
          },
          duration,
          "swing"
        );
        $(".p-header__nav-filter").removeClass("active");
        $(".p-header__nav-filter").fadeOut();
      }
    }
  });

  // ナビの余白クリックでメニュー閉じる
  $headerNav.on("click", function () {
    $hamburgerMenuLine.stop(true).removeClass("active");
    $headerNav.removeClass("open");
    if (mqPC.matches) {
      // sp, tabサイズのとき
      $hamburgerMenuLine.stop(true).removeClass("active");
      $headerNav.removeClass("open");
      $headerNav.stop(true).animate(
        {
          right: "-100vw",
        },
        duration,
        "swing"
      );
    } else {
      // PCサイズのとき
      $headerNav.stop(true).animate(
        {
          right: "-590px",
        },
        duration,
        "swing"
      );
      $(".p-header__nav-filter").removeClass("active");
      $(".p-header__nav-filter").fadeOut();
    }
  });

  // navの外側クリックでnav閉じる
  $(".p-header__nav-filter").on("click", function () {
    $hamburgerMenuLine.stop(true).removeClass("active");
    $headerNav.removeClass("open");
    $headerNav.stop(true).animate(
      {
        right: "-590px",
      },
      duration,
      "swing"
    );
    $(".p-header__nav-filter").removeClass("active");
    $(".p-header__nav-filter").fadeOut();
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
  });
});
