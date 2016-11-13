//js goes here

<<<<<<< HEAD
jQuery(document).ready(function($) {
    console.log('script loaded');

    $(".wordpressplagiarismtracking-quick-insert-widget").submit(function(e) {
        console.log('submit clicked');
        e.preventDefault();
				formData = $(e.target).serialize();
        // var theLink = e.target['_post[post_title]'].value;
        // var theCats = [];
				// var theNotes = e.target['_post[post_content]'].value;
        // $(e.target['_taxonomy[case_category][]']).each(function(i,checkbox) {
				// 	if($(checkbox).attr('checked')){
        //     theCats.push(checkbox.value);
				// 	}
        // });

        // console.log(e, theLink, theCats, theNotes);
				// console.log(formData);
				$.ajax({
					data: {
						action: 'quick_insert',
						formData: formData
					},
					type: "post",
					url: wpm_Ajax.ajaxurl,
					beforeSubmit : function(arr, $form, options){
            arr.push( { "name" : "nonce", "value" : theUniqueNameForYourJSObject.nonce });
        },
					success: function(data){
						console.log(data);
						window.location.replace(data);
					}
				})
        // $.ajax({type: "GET",
        //         url: "http://localhost/case-tracker/open-cases/cat=open",
        //         //data: { id: $("Shareitem").val(), access_token: $("access_token").val() },
        //         error:function(err){
        //         	console.log(err);
        //         },
        //         success:function(result){
        //         	console.log(result);
        //   $(".search-results").html(result);
        // }});
    });

=======
jQuery(document).ready(function($){
	console.log('script loaded');
  
  $('.plagiarism-cases-table').DataTable( {
    searching: false,
    ordering: true,
    pageLength: 10,
  } );
>>>>>>> d09a8bdf85c9ee4ced8afe61142cb381ddcfc124

});


/*


*/
