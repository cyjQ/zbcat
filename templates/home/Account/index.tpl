<{extends file="home/Account/public.tpl"}>
<{block name="content"}>
<div class="account_title">
    资产概览
</div>
<div class="account_info">
    <div class="row hidden-xs">
        <div class="account_sj col-sm-4">
            <span>总收入 :</span>&nbsp;
            <p>50550.00</p>
        </div>
        <div class="account_sj col-sm-4">
            <span>总支出 :</span>&nbsp;
            <p style="color: green">30000.00</p>
        </div>
        <div class="account_sj col-sm-4">
            <span>可支配收入 :</span>&nbsp;
            <p style="color: black">2000.00</p>
        </div>
    </div>
    <table class="visible-xs">
        <tr>
            <td class="title_td">总收入 : &nbsp;</td>
            <td class="title_td">总支出 : &nbsp;</td>
            <td class="title_td">可支配收入 : &nbsp;</td>
        </tr>
        <tr>
            <td class="sj-td" style="color: green">70000.00</td>
            <td class="sj-td" style="color: red">600454.00</td>
            <td class="sj-td" style="color: black">7078780.00</td>
        </tr>
    </table>
</div>

<div class="account_title">
    收支表
</div>
<div class="account_info">
    <table>
        <tr>
            <td></td>
            <td class="title_td">本周</td>
            <td class="title_td">本月</td>
            <td class="title_td">本年</td>
        </tr>
        <tr>
            <td class="title_td">
                <span class="glyphicon glyphicon-plus" style="color: red;font-size: 10px;"></span>
                &nbsp;&nbsp;收入</td>
            <td class="sr-sj">¥320</td>
            <td class="sr-sj">¥3500</td>
            <td class="sr-sj">¥35000</td>
        </tr>
        <tr>
            <td class="title_td">
                <span class="glyphicon glyphicon-minus" style="color: green;font-size: 10px;"></span>
                &nbsp;&nbsp;支出</td>
            <td class="zc-sj">¥120</td>
            <td class="zc-sj">¥1500</td>
            <td class="zc-sj">¥20000</td>
        </tr>
    </table>
</div>
<{/block}>