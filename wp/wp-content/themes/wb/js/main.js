var top_nav_menu = {
  init: function () {
    top_nav_menu.hover_dropdown();
    $('.dropdown-menu a.dropdown-toggle').on('click', function (e) {
      if (!$(this).next().hasClass('show')) {
        $(this).parents('.dropdown-menu').first().find('.show').removeClass('show');
      }
      var $subMenu = $(this).next('.dropdown-menu');
      $subMenu.toggleClass('show');
      $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function (e) {
        $('.dropdown-submenu .show').removeClass('show');
      });
      return false;
    });
  },
  hover_dropdown: function () {
    $('.dropdown').hover(function () {
      $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn(300);
    }, function () {
      $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeOut(300);
    });
    if (window.matchMedia("(min-width: 768px)").matches) {
      $('.navbar .dropdown > a').click(function () {
        location.href = this.href;
      });
    }
  },
};
var mega_menu_cat = {
  init: function () {
    $('.btn-menu-cat,.product-menu-cat').click(function () {
      $(this).toggleClass('show');
      $('.mega-cat').toggleClass('show');
      $('.droplet').toggleClass('show');
    });
    $('.droplet').click(function () {
      $('.btn-menu-cat').toggleClass('show');
      $('.mega-cat').toggleClass('show');
      $(this).toggleClass('show');
    });
  }
}
var search_form = {
  init: function () {
    $('.btn-search-mobile').click(search_form.show);
    if ($(window).width() < 480 || $(window).height() < 480) {
      $(window).bind('scroll', function () {
        if ($(window).scrollTop() > 150) {
          $('.search-form').addClass('show-mobile');
        } else {
          $('.search-form').removeClass('show-mobile');
        }
      });
    }

    $('.btn-search-icon').click(function () {
      $('.search-form').toggleClass('show-fixed');
      return false;
    })

  },
  show: function () {
    $('.search-form').toggleClass('show');
    return false;
  },
};

var common_settings = {
  init: function () {
    $(window).bind('scroll', function () {
      if ($(window).scrollTop() > 150) {
        $('.page-header').addClass('fixed');
      } else {
        $('.page-header').removeClass('fixed');
      }
    });
    $('.btn-back').click(function () {
      window.history.back();
    });
    var input_date = $('[data-toggle="datepicker"]');
    if (input_date.length > 0) {
      $('[data-toggle="datepicker"]').datepicker({
        autoHide: true,
        zIndex: 2048,
        language: 'vi-VN'
      });
    }
    //Responsive Iframe Video 16/9
    $('.entry iframe').addClass('embed-responsive-item');
    $(".entry iframe").wrap("<div class='embed-responsive embed-responsive-16by9'></div>");
    // Back to top button
    $('.btn-to-top').on('click', function (e) {
      e.preventDefault();
      $('html,body').animate({
        scrollTop: 0
      }, 700);
    });

    // Comment box
    var comment_textarea = $('.comment-form [name="comment"]');
    if (comment_textarea.length > 0) {
      comment_textarea.focus(function () {
        $('.comment-form .comment-form-author').addClass('show');
        $('.comment-form .comment-form-email').addClass('show');
      })
    }
  },
}


var home_slider = {
  init: function () {
    var home_slide = $('.hero-slider .list-slider');
    if (home_slide.length > 0) {
      home_slide.slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        arrows: true,
        autoplay: true,
        autoplaySpeed: 2000,
        focusOnSelect: true,
        responsive: [{
          breakpoint: 575,
          settings: {
            dots: true,
            arrows: false,
            slidesToShow: 1,
          }
        }]
      });
    }
  }
}



var suggest_product = {
  init: function () {
    var suggest_product_slider = $('.suggest-product .list-product');
    var number_slide = $('.suggest-product .list-product .col-md-2');
    if (suggest_product_slider.length > 0 && number_slide.length > 6) {
      suggest_product_slider.slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        autoplay: true,
        autoplaySpeed: 4000,
        focusOnSelect: true,
        responsive: [{
            breakpoint: 1441,
            settings: {
              dots: false,
              arrows: true,
              slidesToShow: 6,
              slidesToScroll: 1,
            }
          },
          {
            breakpoint: 576,
            settings: {
              dots: false,
              arrows: false,
              slidesToShow: 2,
              slidesToScroll: 1,
            }
          }
        ]
      });
    }
  }
}

var widget_product = {
  init: function () {
    var widget_product_slide = $('.widget-product-slide .list-product');
    var number_slide = $('.widget-product .list-product .col-md-2');
    if (widget_product_slide.length > 0 && number_slide.length > 6) {
      widget_product_slide.slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        autoplay: true,
        autoplaySpeed: 2000,
        focusOnSelect: true,
        responsive: [{
          breakpoint: 575,
          settings: {
            dots: false,
            arrows: false,
            slidesToShow: 2,
          }
        }]
      });
    }
  }
}

var google_form = {
  init: function () {
    $('#modal-alert-success').on('hidden.bs.modal', function (event) {
      location.reload();
    })
    var call_me_form = $('form.call-me');
    if (call_me_form.length > 0) {
      call_me_form.on('submit', function () {
        var container = $(this);
        var success_heading = 'Gửi thành công';
        var success_message = 'Chúng tôi sẽ sớm kết nối với bạn để xác nhận việc đăng ký';
        google_form.send_numberphone(container, success_heading, success_message);
        return false;
      });
    }
    var contact_form = $('form.contact-form');
    if (contact_form.length > 0) {
      contact_form.on('submit', function () {
        var container = $(this);
        var success_heading = 'Gửi thành công';
        var success_message = 'Chúng tôi sẽ sớm liên hệ với bạn';
        google_form.send_contact(container, success_heading, success_message);
        return false;
      });
    }
  },
  send_numberphone: function (container, success_heading, success_message) {
    var form_data = new FormData();
    var phone = $(container).find('[name="numberphone"]').val();
    var product = $(container).find('[name="product"]').val();
    var data_url = window.location.href;
    var referrer = document.referrer;

    form_data.append('phone', phone);
    form_data.append('product', product);

    form_data.append('data_url', data_url);
    form_data.append('referrer', referrer);
    form_data.append('action', 'form_send_numberphone');

    if ((phone !== "")) {
      $.ajax({
        url: vmajax.ajaxurl,
        data: form_data,
        type: "POST",
        dataType: "xml",
        cache: false,
        contentType: false,
        processData: false,
        statusCode: {
          0: function () {
            $('.modal').modal('hide');
            $('.modal-alert-success .alert-heading').text(success_heading);
            $('.modal-alert-success .alert-message').text(success_message);
            $('#modal-alert-success').modal('show');
          },
          200: function () {
            $('.modal').modal('hide');
            $('.modal-alert-success .alert-heading').text(success_heading);
            $('.modal-alert-success .alert-message').text(success_message);
            $('#modal-alert-success').modal('show');
          }
        }
      });
    } else {
      alert('Kiểm tra lại thông tin bạn vừa nhập');
    }
  },
  send_contact: function (container, success_heading, success_message) {
    var fullname = $(container).find('[name="fullname"]').val();
    var email = $(container).find('[name="email"]').val();
    var numberphone = $(container).find('[name="numberphone"]').val();
    var content = $(container).find('[name="content"]').val();

    var data_url = window.location.href;
    var referrer = document.referrer;

    form_data.append('fullname', fullname);
    form_data.append('numberphone', numberphone);
    form_data.append('email', email);
    form_data.append('content', content);

    form_data.append('data_url', data_url);
    form_data.append('referrer', referrer);
    form_data.append('action', 'form_send_contact');

    if ((fullname !== "" && numberphone !== "")) {
      $.ajax({
        url: vmajax.ajaxurl,
        data: form_data,
        type: "POST",
        dataType: "xml",
        cache: false,
        contentType: false,
        processData: false,
        statusCode: {
          0: function () {
            $('.modal').modal('hide');
            $('.modal-alert-success .alert-heading').text(success_heading);
            $('.modal-alert-success .alert-message').text(success_message);
            $('#modal-alert-success').modal('show');
          },
          200: function () {
            $('.modal').modal('hide');
            $('.modal-alert-success .alert-heading').text(success_heading);
            $('.modal-alert-success .alert-message').text(success_message);
            $('#modal-alert-success').modal('show');
          }
        }
      });
    } else {
      alert('Kiểm tra lại thông tin bạn vừa nhập');
    }
  },
}

var show_more = {
  init: function () {
    var more_tag = $('.archive-description .more-tag');
    more_tag.parent().nextAll().css('display', 'none');
    more_tag.click(function () {
      $(this).hide();
      more_tag.parent().nextAll().css('display', 'block');
      return false;
    })
  }
}

var product_gallery = {
  init: function () {
    // product-gallery
    var single_gallery = $('.single-gallery .list-gallery-large');
    if (single_gallery.length > 0) {
      $('.single-gallery .list-gallery-large').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.single-gallery .list-gallery-thumb',
        autoplay: true,
        autoplaySpeed: 2000,
        lazyLoad: 'ondemand',
      });

      $('.single-gallery .list-gallery-thumb').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.single-gallery .list-gallery-large',
        dots: false,
        arrows: false,
        focusOnSelect: true,
        lazyLoad: 'ondemand',
      });
    }
  }
}

var cart = {
  init: function () {
    // Quantity input
    $(document.body).on('click', '.plus, .minus', function () {
      var $qty = $(this).closest('.quantity').find('.qty'),
        currentVal = parseFloat($qty.val()),
        max = parseFloat($qty.attr('max')),
        min = parseFloat($qty.attr('min')),
        step = $qty.attr('step');

      // Format values
      if (!currentVal || currentVal === '' || currentVal === 'NaN') currentVal = 0;
      if (max === '' || max === 'NaN') max = '';
      if (min === '' || min === 'NaN') min = 0;
      if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN') step = 1;

      // Change the value
      if ($(this).is('.plus')) {
        if (max && (currentVal >= max)) {
          $qty.val(max);
        } else {
          $qty.val(currentVal + parseFloat(step));
        }
      } else {
        if (min && (currentVal <= min)) {
          $qty.val(min);
        } else if (currentVal > 0) {
          $qty.val(currentVal - parseFloat(step));
        }
      }

      // Trigger change event
      $qty.trigger('change');
    });
  }
}

var review = {
  init: function () {

    $.fn.focusTextToEnd = function () {
      this.focus();
      var $thisVal = this.val();
      this.val('').val($thisVal);
      return this;
    }
    // form hoi-dap
    $('body').on('submit', 'form#medi_cmt', function () {
      var name = $(this).find('[name="medi_cmt_name"]').val(),
        email = $(this).find('[name="medi_cmt_email"]').val(),
        content = $(this).find('[name="medi_cmt_content"]').val(),
        post_id = $(this).find('[name="post_ID"]').val(),
        data = {
          'action': 'add_new_hoidap',
          'name': name,
          'email': email,
          'content': content,
          'post_id': post_id
        };
      $.ajax({
        url: vmajax.ajaxurl,
        data: data,
        type: 'POST',
        beforeSend: function (xhr) {
          $("#hoi-dap").addClass('loading_cmt');
        },
        success: function (data) {
          if (name === undefined && email === undefined) {
            alert("Bình luận thành công");
          } else {
            alert("Gửi thành công! Bình luận của bạn đang được chờ duyệt");
          }
          $('form#medi_cmt').find("textarea").val("");
          $("#hoi-dap").removeClass('loading_cmt');
          $("#medi_cmt_reply").remove();
        }
      });
      return false;
    });
    // form reply hoidap
    $('body').on('submit', 'form#medi_cmt_reply', function () {
      var name = $(this).find('[name="medi_cmt_replyname"]').val(),
        email = $(this).find('[name="medi_cmt_replyemail"]').val(),
        content = $(this).find('[name="medi_cmt_replycontent"]').val(),
        post_id = $(this).find('[name="post_ID"]').val(),
        parent = $(this).find('[name="cmt_parent_id"]').val(),
        data = {
          'action': 'add_new_hoidap',
          'name': name,
          'email': email,
          'content': content,
          'post_id': post_id,
          'parent': parent
        };
      $.ajax({
        url: vmajax.ajaxurl,
        data: data,
        type: 'POST',
        beforeSend: function (xhr) {
          $("#hoi-dap").addClass('loading_cmt');
        },
        success: function (data) {
          if (name === undefined && email === undefined) {
            alert("Bình luận thành công");
          } else {
            alert("Gửi thành công! Bình luận của bạn đang được chờ duyệt");
          }
          $('form#medi_cmt').find("textarea").val("");
          $("#hoi-dap").removeClass('loading_cmt');
        }
      });
      return false;
    });
    // button reply hoidap
    $('body').on('click', '#hoi-dap .medi_cmt_reply', function () {
      var parent = $(this).data('cmtid'),
        parent_author = $(this).data('authorname'),
        has_child = $(this).closest("li.medi_comment").find("ul.medi_cmt_child"),
        form_reply = $("#dataform-reply-medi-cmt").html();
      $(".medi_cmt_list_box #medi_cmt_reply").remove();
      if (has_child.length == 1) {
        has_child.find('li').first().prepend(form_reply);
      } else {
        $(this).closest('li.medi_comment').append(form_reply);
      }
      $("#medi_cmt_replycontent").val("@" + parent_author + ": ");
      $("[name='cmt_parent_id'").val(parent);
      $(".medi_cmt_list_box #medi_cmt_reply #medi_cmt_replycontent").focusTextToEnd();
      return false;
    });
    // remove form relpy hoidap
    $('body').on('click', 'form#medi_cmt_reply a.medi_cancel_cmt', function () {
      $(this).closest("#medi_cmt_reply").remove();
      return false;
    });
    // hiện form review
    $('body').on('click', '#comments a.btn-reviews-now', function () {
      if ($("#review_form_wrapper #commentform").length) {
        $("body").addClass('medi-review');
      } else {
        var comment_offset = $("#commentform").offset().top;
        $("html,body").animate({
          scrollTop: comment_offset - 200
        }, 700)
      }
      return false;
    });
    // ẩn form review
    $('body').on('click', '#review_form_wrapper .bg-review-form, #review_form .close-form-review', function () {
      $("body").removeClass('medi-review');
      return false;
    });
    // page review
    $('body').on('click', '#pagination-review span.page-numbers', function () {
      var pages = $(this).data('pages'),
        max_pages = $(this).closest('#pagination-review').data('max_pages'),
        post_id = $(this).closest('#pagination-review').data('post_id'),
        data = {
          'action': 'load_paginate_comment',
          'max_pages': max_pages,
          'pages': pages
        },
        data_review = {
          'action': 'load_review',
          'post_id': post_id,
          'pages': pages
        };
      $.ajax({
        url: vmajax.ajaxurl,
        data: data,
        type: 'POST',
        beforeSend: function (xhr) {
          $("#reviews").addClass('loading_cmt');
        },
        success: function (data) {
          $("#reviews").removeClass('loading_cmt');
          if (data) {
            $('#pagination-review').html(data);
          }
        }
      });
      $.ajax({
        url: vmajax.ajaxurl,
        data: data_review,
        type: 'POST',
        success: function (data) {
          if (data) {
            $('.medi-list-review .comment-list').html(data);
          }
          $("html,body").animate({
            scrollTop: $("#reviews #comments").offset().top
          }, 300);
        }
      });
      return false;
    });
    // page hoidap
    $('body').on('click', '#pagination-hoidap span.page-numbers', function () {
      var pages = $(this).data('pages'),
        max_pages = $(this).closest('#pagination-hoidap').data('max_pages'),
        post_id = $(this).closest('#pagination-hoidap').data('post_id'),
        data = {
          'action': 'load_paginate_comment',
          'max_pages': max_pages,
          'pages': pages
        },
        data_review = {
          'action': 'load_hoidap',
          'post_id': post_id,
          'pages': pages
        };
      $.ajax({
        url: vmajax.ajaxurl,
        data: data,
        type: 'POST',
        beforeSend: function (xhr) {
          $("#hoi-dap").addClass('loading_cmt');
        },
        success: function (data) {
          $("#hoi-dap").removeClass('loading_cmt');
          if (data) {
            $('#pagination-hoidap').html(data);
          }
        }
      });
      $.ajax({
        url: vmajax.ajaxurl,
        data: data_review,
        type: 'POST',
        success: function (data) {
          if (data) {
            $('.medi_cmt_list_box > ul').html(data);
          }
          $("html,body").animate({
            scrollTop: $("#hoi-dap").offset().top
          }, 300);
        }
      });
      return false;
    });
    // add select star
    $(window).load(function () {
      $('.woocommerce-Reviews .comment-form-rating p.stars').addClass('selected');
      $('.woocommerce-Reviews .comment-form-rating p.stars .star-5').addClass('active');
      $('.woocommerce-Reviews .comment-form-rating #rating').val('5');
      $('.woocommerce-Reviews .comment-form-rating #rating option').each(function () {
        var num = $(this).attr('value'),
          text = $(this).text();
        $('.woocommerce-Reviews .comment-form-rating p.stars .star-' + num + '').attr('data-text', text);
      })
    });

    // Annv - Add attachment review
    var imagesPreview = function (input, placeToInsertImagePreview) {
      if (input.files) {
        var filesAmount = input.files.length;
        var fileTypes = ['jpg', 'jpeg', 'png'];
        if (filesAmount <= 5) {
          for (i = 0; i < filesAmount; i++) {
            var reader = new FileReader();
            var extension = input.files[i].name.split('.').pop().toLowerCase();
            var isSuccess = fileTypes.indexOf(extension) > -1;
            if (isSuccess) {
              var size_img = (input.files[i].size) / 1024;
              if (size_img > 100) {
                alert('Ảnh vượt quá 100Kb, vui lòng resize kích thước ảnh trước khi upload');
              } else {
                reader.onload = function (event) {
                  $('.upload-prod-pic-wrap ul').append('<li><span class="trash-ico"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M13 12l5-5-1-1-5 5-5-5-1 1 5 5-5 5 1 1 5-5 5 5 1-1z"></path></svg></span><div class="img-wrap-box"><img src="' + event.target.result + '"></div></li>');
                }
                reader.readAsDataURL(input.files[i]);
              }
            } else {
              alert('Chỉ chấp nhận tập tin hình ảnh');
            }
          }
        } else {
          alert('Upload tối đa 5 ảnh');
        }
      }
    };

    $('#attachment').on('change', function () {
      imagesPreview(this, '.upload-prod-pic-wrap ul');
      setTimeout(function () {
        showpreview();
      }, 300);
    });
    $('.drv_insert_attach').click(function () {
      $('.review-rating-real-photos').toggleClass('show');
      $('.drv_insert_attach').hide();
      $('.drv_collapse_attach').addClass('active');
    });
    $('.drv_collapse_attach').click(function () {
      $(this).removeClass('active');
      $('.review-rating-real-photos').removeClass('show');
      $('.drv_insert_attach').show();
    });

    function showpreview() {
      var lth = $('.upload-prod-pic-wrap ul li').length;
      if (lth == 0) {
        $('#superadminpic').attr({
          'src': ''
        })
      }
      $('.upload-prod-pic-wrap ul li').each(function (key, val) {
        if (key == lth - 1) {
          $('#superadminpic').attr({
            'src': $(this).find('img').attr('src')
          })
        } else {}
      });
      if (lth >= 5) {
        $('.camera').hide()
      } else {
        $('.camera').show()
      }

      $(".upload-prod-pic-wrap ul li .trash-ico").click(function () {
        $(this).parent().remove();
        $("#attachment").val('');
        showpreview();
      });
    }
  }
};

var shopping_cart = {
  init: function () {
    var add_to_cart = $('.add-to-cart-link');
    if (add_to_cart.length > 0) {
      // add_to_cart.click(function(){
      $('body').on('click', '.add-to-cart-link', function () {
        var container = $(this);
        shopping_cart.add_product_to_cart(container);
        return false;
      });
    }
  },
  add_product_to_cart: function (container) {
    var product_id = $(container).data('product-id');
    var product_quantity = 1;
    if ((product_id !== "")) {
      $.ajax({
        type: "POST",
        url: vmajax.ajaxurl,
        data: {
          'action': 'add_to_cart',
          'product_id': product_id,
          'product_quantity': product_quantity,
        },
        type: "POST",
        dataType: "xml",
        beforeSend: function () {
          $(container).addClass('loading');
        },
        statusCode: {
          0: function () {
            shopping_cart.animate_to_cart($(container), product_quantity);
            $(container).removeClass('loading');
            return false;
          },
          200: function () {
            shopping_cart.animate_to_cart($(container), product_quantity);
            $(container).removeClass('loading');
            return false;
          }
        }
      });
    }
  },
  animate_to_cart: function (container, product_quantity) {
    var cart = $('.mini-shopping-cart');

    var imgtodrag = $(container).parent().find("img").eq(0);
    if (imgtodrag) {
      var imgclone = imgtodrag.clone()
        .offset({
          top: imgtodrag.offset().top,
          left: imgtodrag.offset().left
        })
        .css({
          'opacity': '0.5',
          'position': 'absolute',
          'height': '150px',
          'width': '150px',
          'z-index': '100'
        })
        .appendTo($('body'))
        .animate({
          'top': cart.offset().top + 10,
          'left': cart.offset().left + 10,
          'width': 75,
          'height': 75
        }, 1000);
      setTimeout(function () {
        var cart_number = parseInt($('.mini-shopping-cart .number-cart').text());
        var number_add = parseInt(product_quantity);
        var number_text = cart_number + number_add;
        $('.mini-shopping-cart .number-cart').text(number_text);
      }, 1500);
      imgclone.animate({
        'width': 0,
        'height': 0
      }, function () {
        $(this).detach()
      });
    }
  }
}

var checkout = {
  init: function () {
    var checkout_form = $('.checkout-form');
    if (checkout_form.length > 0) {
      checkout_form.on('submit', function () {
        var container = $(this);
        checkout.send_order_to_google(container);
        return false;
      });
    }
  },

  send_order_to_google: function (container) {
    var fullname = $(container).find('input[name="fullname"]').val();
    var numberphone = $(container).find('input[name="numberphone"]').val();
    var email = $(container).find('input[name="email"]').val();
    var address = $(container).find('input[name="address"]').val();
    var order_note = $(container).find('[name="order-note"]').val();
    var product = $(container).find('[name="product"]').val();
    var total = $(container).find('[name="total"]').val();
    if ((fullname !== "") && (numberphone !== "")) {
      $('#modal-checkout .order-name').text(fullname);
      $('#modal-checkout .order-numberphone').text(numberphone);
      $('#modal-checkout .order-addr').text(address);
      $('#modal-checkout .order-note').text(order_note);
      $('#modal-checkout').modal('show');
      $.ajax({
        type: "POST",
        url: vmajax.ajaxurl,
        data: {
          'action': 'checkout_process',
        },
        type: "POST",
        dataType: "xml",
        statusCode: {
          0: function () {
            setTimeout(function () {
              $('#modal-checkout').modal('hide');
            }, 5000);
            return false;
          },
          200: function () {
            setTimeout(function () {
              $('#modal-checkout').modal('hide');
            }, 5000);
            return false;
          }
        }
      });
      setTimeout(function () {
        $('#modal-checkout').modal('hide');
      }, 5000);

      $('#modal-checkout').on('hidden.bs.modal', function (e) {
        $.ajax({
          url: "https://docs.google.com/forms/u/0/d/e/1FAIpQLSez7FYkQ-DMNS0l6-NjSk89eBab-OammwszJm2WmP97cXzCeA/formResponse",
          data: {
            "entry.950128506": fullname,
            "entry.1875047726": numberphone,
            "entry.1259590767": email,
            "entry.1744791508": address,
            "entry.814939027": order_note,
            "entry.827779994": product,
            "entry.406850060": total
          },
          type: "POST",
          dataType: "xml",
          statusCode: {
            0: function () {
              var host_name = window.location.hostname;
              var protocol = window.location.protocol;
              var url_thanks = protocol + '//' + host_name + '/cam-on';
              $(location).attr("href", url_thanks);
            },
            200: function () {
              var host_name = window.location.hostname;
              var protocol = window.location.protocol;
              var url_thanks = protocol + '//' + host_name + '/cam-on';
              $(location).attr("href", url_thanks);
            }
          }
        });
      })

    } else {
      alert('Kiểm tra lại các thông vừa nhập')
    }
  },
}
var livechat = {
  init: function () {
    $('.btn-livechat').click(function () {
      $(this).toggleClass('show');
      $('.live-support').toggleClass('show');
    })
    $(document).click(function (e) {
      if (!$(event.target).closest(".live-support, .btn-livechat").length) {
        $(".btn-livechat, .live-support").removeClass('show');
      }
    })
  }
}
// Slider partner
var home_partner = {
  init: function () {
    var slider_partner = $('.home-partner .list-partner');
    if (slider_partner.length > 0) {
      slider_partner.slick({
        lazyLoad: 'ondemand',
        dots: false,
        arrows: false,
        infinite: true,
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        responsive: [{
            breakpoint: 768,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 1
            }
          },
          {
            breakpoint: 576,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 1
            }
          },
          {
            breakpoint: 416,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1
            }
          }
        ]
      });
    }
  }
}
var featured_content = {
  init: function () {
    var feautured_content_slider = $('.featured-content .list-featured-text');
    var number_slide = $('.featured-content .list-featured-text .col-md-3');
    if (feautured_content_slider.length > 0 && number_slide.length > 3) {
      feautured_content_slider.slick({
        mobileFirst: true,
        slidesToShow: 2,
        slidesToScroll: 1,
        dots: false,
        arrows: false,
        centerMode: true,
        centerPadding: '30px',
        responsive: [{
          breakpoint: 575,
          settings: "unslick"
        }]
      });
    }
  }
}

var filter = {
  init: function () {
    $("body").on('click', '.product-filter .filter-item.has-child .label', function () {
      $(".product-filter .box-select").removeClass('show');
      $('.product-filter .filter-item').removeClass('show');
      $(this).next().addClass('show');
      $(this).parent().addClass('show');
    });
    $(document).click(function (e) {
      if (!$(event.target).closest(".product-filter .label, .product-filter .box-select").length) {
        $(".product-filter .box-select").removeClass('show');
        $('.product-filter .filter-item').removeClass('show');
      }
    })
  }
}


jQuery(document).ready(function () {

  top_nav_menu.init();
  search_form.init();
  common_settings.init();
  home_slider.init();
  suggest_product.init();
  widget_product.init();
  show_more.init();
  product_gallery.init();
  google_form.init();
  cart.init();
  review.init();
  shopping_cart.init();
  checkout.init();
  mega_menu_cat.init();
  livechat.init();
  home_partner.init();
  featured_content.init();
  filter.init();
});