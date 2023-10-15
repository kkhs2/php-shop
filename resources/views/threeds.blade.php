@extends('common.master')
@section('content')
<script src="https://checkoutshopper-test.adyen.com/checkoutshopper/sdk/5.42.0/adyen.js"
     integrity="sha384-PMAmeZG/M005l456dtr3YFnLXyBwhDuZ3m6xTQ11Emy7YnD0ZpiIObEwb8EnARU8"
     crossorigin="anonymous"></script>

<link rel="stylesheet"
     href="https://checkoutshopper-test.adyen.com/checkoutshopper/sdk/5.42.0/adyen.css"
     integrity="sha384-BRZCzbS8n6hZVj8BESE6thGk0zSkUZfUWxL/vhocKu12k3NZ7xpNsIK39O2aWuni"
     crossorigin="anonymous">


<input type="hidden" name="action" id="action" value="{{ $action }}">
<div id="threeds-container"></div>

<form method="POST" name="threeDsForm" id="threeDsForm" action="{{ url('payment/threeds') }}">
  <input type="hidden" name="stateDataDetails" id="stateDataDetails" value="">
</form>



<script type='text/javascript'>
const configuration = {
  locale: window.navigator.language,
  environment: 'test', 
  clientKey: 'test_UQJEDZBI6NFGTL2MV4ZTFBYRZIMJ7EWR',
  onAdditionalDetails: (state, component) => {
  
    document.getElementById("stateDataDetails").value = JSON.stringify(state.data);
    document.getElementById("threeDsForm").submit();
    /*$.ajax({
      type: 'POST',
      url: '/payment/threeds',
      data: {
        details: state.data.details
      },
      success: function(response) {
        
      }
    });*/

   
  }
}
 
const checkout = AdyenCheckout(configuration);

const threeDSConfiguration = {
  challengeWindowSize: '02'
};

checkout.then((response) => {
  const action = JSON.parse(document.getElementById('action').value);
  response.createFromAction(action, threeDSConfiguration).mount('#threeds-container');
});

</script>
@endsection