<tbody>
    <tr style="background:#fff">
      <td align="left" width="600" height="auto" style="padding:15px">
        <table>
          <tbody>
            <tr>
              <td>
            <h3 style="font-size:13px;font-weight:bold;color:#02acea;text-transform:uppercase;margin:20px 0 0 0;border-bottom:1px solid #ddd">Thông tin đơn hàng #725145168
              <span style="font-size:12px;color:#777;text-transform:none;font-weight:normal">({{ $bill->fullname }})</span>
            </h3>
          </td>
        </tr>
        <tr>
          </tr><tr>
            <td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
              <table cellspacing="0" cellpadding="0" border="0" width="100%">
                <thead>
                  <tr>
                    <th align="left" width="50%" style="padding:6px 9px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold">Thông tin thanh toán</th>
                    <th align="left" width="50%" style="padding:6px 9px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold">Địa chỉ giao hàng</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td valign="top" style="padding:3px 9px 9px 9px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">

                      <span style="text-transform:capitalize">{{ $bill->fullname }}</span>
                      <br>  <a href="mailto:thientran98qb@gmail.com" target="_blank">{{ $user->email }}</a>
                      <br>  {{ $bill->phone_number }}

                    </td>
                    <td valign="top" style="padding:3px 9px 9px 9px;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">
                       {{ $bill->address }}
                    </td>
                  </tr>
                  <tr>
                    <td valign="top" style="padding:7px 9px 0px 9px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444" colspan="2">
                      <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:normal">
                        <br>
                        <strong>Phí vận chuyển: </strong>0&nbsp;₫
                        <br>
                        <strong>Phương thức thanh toán: </strong>Thanh toán tiền mặt khi nhận hàng


                        <br>
                        <strong>Xuất hóa đơn điện tử: </strong>{{ $bill->fullname }}
                        <br> -------
                        <br> {{ $bill->address }}
                    </p></td>
                  </tr>
                </tbody>
              </table>
            </td>
          </tr>
          <tr>
            <td>
              <h2 style="text-align:left;margin:10px 0;border-bottom:1px solid #ddd;padding-bottom:5px;font-size:13px;color:#02acea">CHI TIẾT ĐƠN HÀNG</h2>
              <table cellspacing="0" cellpadding="0" border="0" width="100%" style="background:#f5f5f5">
<thead>
<tr>
    <th align="left" bgcolor="#02acea" style="padding:6px 9px;color:#fff;text-transform:uppercase;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Sản phẩm</th>
    <th align="left" bgcolor="#02acea" style="padding:6px 9px;color:#fff;text-transform:uppercase;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px"> Đơn giá</th>
    <th align="left" bgcolor="#02acea" style="padding:6px 9px;color:#fff;text-transform:uppercase;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Số lượng</th>
    <th align="left" bgcolor="#02acea" style="padding:6px 9px;color:#fff;text-transform:uppercase;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Giảm giá</th>
    <th align="right" bgcolor="#02acea" style="padding:6px 9px;color:#fff;text-transform:uppercase;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Tổng tạm</th>
</tr>
</thead>

    <tbody bgcolor="#eee" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
        @foreach ($bill->products as $product)
        <tr>
            <td align="left" valign="top" style="padding:3px 9px">
                <strong>
                    {{$product->product_name}}
                </strong>
            </td>
            <td align="left" valign="top" style="padding:3px 9px">
                <span>{{$product->price}}&nbsp;₫</span>
            </td>
            <td align="left" valign="top" style="padding:3px 9px">{{$product->pivot->quantity}}</td>
            <td align="left" valign="top" style="padding:3px 9px">
                <span>0&nbsp;₫</span>
            </td>
            <td align="right" valign="top" style="padding:3px 9px">
                <span>{{$product->pivot->quantity * $product->price}}&nbsp;₫</span>
            </td>
        </tr>
        @endforeach
    </tbody>

<tfoot style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
                <tr>
    <td colspan="4" align="right" style="padding:5px 9px">Chi phí vận chuyển</td>
    <td align="right" style="padding:5px 9px"><span>0&nbsp;₫</span></td>
</tr>

                 <tr bgcolor="#eee">
    <td colspan="4" align="right" style="padding:7px 9px"><strong><big>Tổng giá trị đơn hàng</big></strong></td>
    <td align="right" style="padding:7px 9px"><strong><big><span>{{$bill->total_price}}&nbsp;₫</span></big></strong></td>
</tr>
</tfoot>

</table>

              <br>
            </td>
          </tr>
          <tr>
            <tr>
              <td>
                <br>
                <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;margin:0;padding:0;line-height:18px;color:#444;font-weight:bold">
                Fowa cảm ơn quý khách,
                  <br>
                </p>
              </td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
  </tbody>
