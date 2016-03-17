   <div class="fabiao gong font28 ckk" style="display: none">
                                <form action="__APP__/member/addcommenthf" method="post" id="comment22">
                                    @{$v['user']['username']}<textarea id="xiaomao1" name="content" class="font28" placeholder="仅限五十字以内"></textarea>
                                    <input type="hidden" name="uid" value="{$u_id}">
                                    <input type="hidden" name="hfid" value="{$v.id}">
                                    <input type="hidden" name="number" value="{:I('number')}">
                                </form>
                                 <button type="button"  id="fabiao1" >发表</button>
   </div>
<script type="text/javascript">
            $('#fabiao1').click(function(){
              var myText= $('#xiaomao1').val().length;
              if(myText<5){
                  alert('不能小于5个字符');
                   return false;
              }
              $('#comment22').submit();
         });
</script>