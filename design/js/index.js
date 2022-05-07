$(function () {
  //Dashboard toggle info
  $(".toggle-info").click(function () {
    $(this).parent().next(".panel-body").slideToggle(500);
    $(this).children("i").toggleClass("fa-plus fa-minus");
  });

  $("i.fa-plus").click(function () {
    $(".wrap").animate({ width: "0" }, 800, function () {
      $(".stg").hide();
      $(".ent").show();
    });
    $(".wrap").animate({ width: "100%" }, 800);
  });

  $("i.fa-minus").click(function () {
    $(".wrap").animate({ width: "0" }, 800, function () {
      $(".ent").hide();
      $(".stg").show();
    });
    $(".wrap").animate({ width: "100%" }, 800);
  });

  // start etudiant
  //required inputs
  $("input").each(function () {
    if ($(this).attr("required")) {
      $(this).after("<span class='asterik'>*</span>");
    }
  });

  //password eye eye-slashe (show/hide)
  $(".fas").click(function () {
    $(this).toggleClass("fa-eye-slash fa-eye");

    //
    if ($(this).prevAll("input").attr("type") == "password") {
      $(this).prevAll("input").attr("type", "text");
    } else {
      $(this).prevAll("input").attr("type", "password");
    }
  });
});
