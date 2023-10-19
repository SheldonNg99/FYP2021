paypal.Buttons({
  style:{
    color: 'blue',
    shape: 'pill'
  },
  createOrder:function(data, actions){
    return actions.order.create({
      purchase_units:[{
        amount:{
          value: document.getElementById("total_amount").value
        }
      }]
    });
  },
  onApprove:function(data, actions){
    return actions.order.capture().then(function(details){
      actions.redirect('thank_you.html');
      console.log(details)
    })
  },
  onCancel: function (data, actions) {
  // Show a cancel page, or return to cart
  }
}).render('#paypal-payment-button');
