$(document).ready(function () {
    // let filter =
    // console.log(filter);
    //     if (filter === false){
    //         $(".toggle").hide();
    //         $("#expand").click(function () {
    //             $(".toggle").toggle();
    //             $("#expand").toggleClass("fa-chevron-down fa-chevron-up");
    //         });
    //     } else {
    //         $("#expand").click(function () {
    //             $(".toggle").toggle();
    //             $("#expand").toggleClass("fa-chevron-up fa-chevron-down");
    //         });
    //     }
    $(".toggle").hide();
    $("#expand").click(function () {
        $(".toggle").toggle();
        $("#expand").toggleClass("fa-chevron-down fa-chevron-up");
    })
});