         {this.state.receiver_id?
          (
          this.state.users.map(data=>{


          if(data.id===this.state.receiver_id){
             {alert(data.id)}
           return(
             <div className="card">
                  <div className="card-header msg_head">
                   <div className="d-flex bd-highlight">
                     <div className="img_cont">
                       <img src={Img} className="rounded-circle user_img"/>
                       <span className="online_icon"></span>
                     </div>
                     <div className="user_info">
                       <span>{data.firstName} {data.lastName}</span>
                       <p>1767 Messages</p>
                     </div>
                     <div className="video_cam">
                       <span><i className="fas fa-video"></i></span>
                       <span><i className="fas fa-phone"></i></span>
                     </div>
                   </div>
                   <span id="action_menu_btn"><i className="fas fa-ellipsis-v"></i></span>
                   <div className="action_menu">
                     <ul>
                       <li><i className="fas fa-user-circle"></i> View profile</li>
                       <li><i className="fas fa-users"></i> Add to close friends</li>
                       <li><i className="fas fa-plus"></i> Add to group</li>
                       <li><i className="fas fa-ban"></i> Block</li>
                     </ul>
                   </div>
                 </div>
                 <ul className="card-body msg_card_body" id="msg_card_body">

                                    {
                                    this.state.message?
                                     (
                                    this.state.message.map(data=>{
                                    return(
                                      data.from==localStorage.getItem('id')?(
                                        <div className="d-flex justify-content-end mb-4">
                                        <div className="msg_cotainer_send" style={{minWidth:'130px'}}>
                                        {data.message}
                                            <span className="msg_time_send ">{data.created_at}</span>
                                          </div>
                                          <div className="img_cont_msg">
                                          <img src={Img} className="rounded-circle user_img_msg"/>
                                          </div>
                                          </div>

                                      ):(
                                        <div className="d-flex justify-content-start mb-4">
                                         <div className="img_cont_msg" >
                                           <img src={Img} className="rounded-circle user_img_msg"/>
                                         </div>
                                         <div className="msg_cotainer" style={{minWidth:'130px'}}>
                                            {data.message}
                                           <span className="msg_time">{data.created_at}</span>
                                         </div>
                                       </div>
                                      )

                                    )
                                    })

                                  ):<h1>no</h1>
                                    }


                                                             </ul>



           )

          }

          }
          )
        )
:<h1>no</h1>





          }





























          componentWillMount() {
  axios.request({
  method:'get',
  url:API+'/getUser',
  params:{
    logged_user:localStorage.getItem('id'),
  },
  })
  .then((res)=>{      
    this.setState({
      isLoading: false,
      users:res.data
    });

     })
  .catch(ex =>{
    this.setState({
      loadingFailed:true,
      isLoading: false,
    });

  })
  Pusher.logToConsole = true;
  var pusher = new Pusher('3346cec27d06f7394391', {
      cluster: 'ap2',
      forceTLS: true,
       encrypted: true
  });
var channel = pusher.subscribe('my-channel');
channel.bind('my-event',data  => {
//alert(JSON.stringify(data));
this.setState({
  receiver_id:data.to,
  sender_id:data.from,
});
  //$('#'+this.state.receiver_id).click();

  $('#msg_card_body').animate({
      scrollTop: $('#msg_card_body').get(0).scrollHeight
  }, 100);

  });
}


  handleCheck(id,firstName,lastName,email) {
    ReactDom.render(<Conversation id={id} firstName={firstName} lastName={lastName} email={email}/>,document.getElementById('chat'));
  }



sendMessage(e) {
if (e.key === 'Enter' &&  $('#message').val()!==null) {
var receiver_id=this.state.receiver_id;
var sender_id=localStorage.getItem('id');
var message=$('#message').val();
 $('#message').val('')
                    axios.request({
                    method:'get',
                    url:API+"/message",
                    params:{
                      sender_id:sender_id,
                      receiver_id:receiver_id,
                      message:message,
                    },
                    })
                    .then((res)=>{
                      console.log(res);
                      //this.setState({message:res.data});
                  })
                    .catch(ex =>{
                      console.log(ex);
                    })


}
}





  <div className="container-fluid h-100">
      <div className="row justify-content-center h-100">
        <div className="col-md-5 col-xl-4 chat"><div className="card mb-sm-3 mb-md-0 contacts_card">
          <div className="card-header">
          <h2 className="text-light">Whom you want chat with?  </h2>
            <div className="input-group">
              <input type="text" placeholder="Search..." name="" className="form-control search"/>
              <div className="input-group-prepend">
                <span className="input-group-text search_btn"><i className="fas fa-search"></i></span>
              </div>
            </div>
          </div>

          <div className="card-body contacts_body">
            <ui className="contacts">
            <h1>{alert(this.state.message)}</h1>
            {
                  this.state.users.map(data=>{

                    return(
                      <li  onClick={()=>this.handleCheck(data.id,data.firstName,data.lastName,data.email)} id={data.id}>
                      <div className="d-flex bd-highlight">
                        <div className="img_cont">
                          <img src={Img} className="rounded-circle user_img"/>
                          <span className="online_icon"></span>
                        </div>
                        <div className="user_info">
                          <span>{data.firstName} {data.lastName}</span>
                          <p>{data.firstName} is online</p>
                        </div>
                      </div>

                     </li>
                    )
                  })
                 }
            </ui>
          </div>

          <div className="card-footer"/>
        </div></div>
        <div className="col-md-8 col-xl-6 chat" id='chat'/>


      </div>
    </div>




      if(this.state.isLoading){
   return  <LoadingSpinner />
  }
if(this.state.loadingFailed){
   return  <FailToLoad />
}