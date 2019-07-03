jQuery(window).load(function () {
  const apiUrl = "https://preview.ninjateam.org/filebird/wp-json/filebird/v1/add";
  const TB_WIDTH = 500;
  const TB_HEIGHT = 330;
  var urlRedirect = '';
  let selected = 'Unselected', key = 'none';

  function callApi(key, feed) {
    jQuery.ajax({
      method: "POST",
      contentType: "application/json",
      url: apiUrl,
      data: JSON.stringify({ key: key, feed: feed }),
      dataType: "json"
    })
      .done(function (res) {
        window.location.href = urlRedirect;
      })
      .fail(function (res) {
        console.log("Feedback can't submit");
        console.log(res.responseText);
        window.location.href = urlRedirect;
      });
  }

  document
    .querySelector('[data-slug="filebird"] a, [data-slug="filebird-lite"] a')
    .addEventListener("click", function (event) {
      event.preventDefault();
      urlRedirect = document
        .querySelector('[data-slug="filebird"] a, [data-slug="filebird-lite"] a')
        .getAttribute("href");
      tb_show(
        "Quick Feedback - FileBird",
        "#TB_inline?height=370&amp;width=470&amp;inlineId=filebird-feedback-window"
      );
      jQuery("#TB_window").css({
        marginLeft: "-" + parseInt(TB_WIDTH / 2, 10) + "px",
        width: TB_WIDTH + "px",
        height: TB_HEIGHT + "px",
        marginTop: parseInt((jQuery(window).height() - TB_HEIGHT) / 2, 10) + "px"
      });

      jQuery(window).resize(function () {
        jQuery("#TB_window").css({
          marginLeft: "-" + parseInt(TB_WIDTH / 2, 10) + "px",
          width: TB_WIDTH + "px",
          height: TB_HEIGHT + "px",
          marginTop: parseInt((jQuery(window).height() - TB_HEIGHT) / 2, 10) + "px"
        });
      });

      jQuery("#TB_ajaxContent input[type=radio]").on("change", function () {
        selected = jQuery("input[name=reasons]:checked", "#TB_ajaxContent").val();
        key = jQuery("input[name=reasons]:checked", "#TB_ajaxContent").attr("id");
        if (key === "other") {
          jQuery("#feedback-suggest-plugin").hide();
          jQuery("#feedback-description").show();
          jQuery("#feedback-description").on("change", function () {
            selected = jQuery("#feedback-description").val();
          });
          jQuery("#TB_window").css({
            marginLeft: "-" + parseInt(TB_WIDTH / 2, 10) + "px",
            width: TB_WIDTH + "px",
            height: "400px"
          });
        }
        else if (key === 'found_better_plugin') {
          jQuery("#feedback-description").hide();
          jQuery("#feedback-suggest-plugin").show();
          jQuery("#feedback-suggest-plugin").on("change", function () {
            selected = jQuery("#feedback-suggest-plugin").val();
          })
          jQuery("#TB_window").css({
            marginLeft: "-" + parseInt(TB_WIDTH / 2, 10) + "px",
            width: TB_WIDTH + "px",
            height: "360px"
          });
        }
        else {
          jQuery("#feedback-description").hide();
          jQuery("#feedback-suggest-plugin").hide();
          jQuery("#TB_window").css({
            marginLeft: "-" + parseInt(TB_WIDTH / 2, 10) + "px",
            width: TB_WIDTH + "px",
            height: TB_HEIGHT + "px"
          });
        }
      });
      jQuery("#feedback-submit").click(function () {
        callApi(key, selected);
      });
      jQuery("#feedback-skip").click(function () {
        callApi('skip', 'skip');
      });
    });
});
