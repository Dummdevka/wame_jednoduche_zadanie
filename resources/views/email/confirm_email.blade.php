<style>
    * {
        font-family: Arial;
    }
    a {
        text-decoration: none;
        color: #fff;
    }
    .see_btn{
        appearance: none;
        background-color: #2ea44f;
        border: 1px solid rgba(27, 31, 35, .15);
        border-radius: 6px;
        box-shadow: rgb(27 31 35 / 10%) 0 1px 0;
        box-sizing: border-box;
        color: #fff;
        cursor: pointer;
        display: inline-block;
        font-family: -apple-system,system-ui,"Segoe UI",Helvetica,Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji";
        font-size: 14px;
        font-weight: 600;
        line-height: 20px;
        padding: 6px 16px;
        position: relative;
        text-align: center;
        text-decoration: none;
        user-select: none;
        -webkit-user-select: none;
        touch-action: manipulation;
        vertical-align: middle;
        white-space: nowrap;
    }
</style>
<div>
    <h1>Hello,</h1>
    <p>Thank you for redistration as <b>WAWE test CRM</b></p>
    <button class="see_btn">
        <a href="{{$link}}">Confirm</a>
    </button>
    @include('components.logo')
</div>