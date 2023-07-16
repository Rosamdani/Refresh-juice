$(document).ready(function () {
  const sidebar = $("#sidebar");
  const content = $("#content");
  const sidebarToggle = $("#sidebarToggle");
  const links = $("div[data-page]");
  const linkTexts = $(".linkText");
  const pageText = $(".pageText");

  // Load initial page
  loadPage("dashboard");

  // Handle sidebar toggle
  sidebarToggle.click(function () {
    sidebar.toggleClass("w-16 w-[400px]");
    content.toggleClass("pl-0 pl-6");
    linkTexts.toggleClass("hidden");
    setTimeout(function () {
      content.toggleClass("transition-all");
    }, 300);
  });

  // Handle link clicks
  links.click(function (e) {
    e.preventDefault();
    const page = $(this).data("page");
    loadPage(page);
  });

  // Handle link clicks
  links.click(function (e) {
    e.preventDefault();
    const page = $(this).find(".textLink").text().toLowerCase();
    loadPage(page);
    const linkText = $(this).find('.linkText').text();
    
    links.removeClass("border-l-4 border-blue-500 bg-blue-500 bg-opacity-50");
    $(this).addClass("border-l-4 border-blue-500 bg-blue-500 bg-opacity-50");
  });

  // Function to load page content
  function loadPage(page) {
    const url = "content.php?page=" + page;
    $.ajax({
      url: url,
      type: "GET",
      dataType: "html",
      success: function (data) {
        content.html(data);
      },
      error: function () {
        content.html("<p>Failed to load page.</p>");
      },
    });
  }


  // Add border to active link
  links
    .first()
    .addClass("border-l-4 border-blue-500 bg-blue-500 bg-opacity-50");
});
