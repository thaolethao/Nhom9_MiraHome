<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data)
        ]);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function confirm_momo(Request $request)
    {
        if ($request->isMethod('post')) {

            $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

            $partnerCode = 'MOMOBKUN20180529';
            $accessKey = 'klm05TvNBzhg7h7j';
            $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

            $orderInfo = "Thanh toán qua mã QR MoMo";
            $amount = $request->input('total');
            $orderId = time() . "";
            $redirectUrl = url('/momo-return');
            $ipnUrl = url('/momo-notify');
            $extraData = "";

            $requestId = time() . "";
            $requestType = "captureWallet";

            $rawHash = "accessKey=" . $accessKey .
                "&amount=" . $amount .
                "&extraData=" . $extraData .
                "&ipnUrl=" . $ipnUrl .
                "&orderId=" . $orderId .
                "&orderInfo=" . $orderInfo .
                "&partnerCode=" . $partnerCode .
                "&redirectUrl=" . $redirectUrl .
                "&requestId=" . $requestId .
                "&requestType=" . $requestType;

            $signature = hash_hmac("sha256", $rawHash, $secretKey);

            $data = [
                'partnerCode' => $partnerCode,
                'partnerName' => "Test",
                'storeId' => "MomoTestStore",
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'lang' => 'vi',
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature
            ];

            $result = $this->execPostRequest($endpoint, json_encode($data));
            $jsonResult = json_decode($result, true);
            // dd($jsonResult);
            return redirect($jsonResult['payUrl']);
        }

        return redirect()->back()->with('error', 'Yêu cầu không hợp lệ');
    }

    public function showCheckout()
    {
        return view('mirahome.checkout');
    }

    public function index(Request $request)
    {
        $total = $request->query('total');
        return view('mirahome.checkout', compact('total'));
    }

    public function momoReturn(Request $request)
    {
        return view('mirahome.momo_return', [
            'message' => $request->query('message'),
            'orderId' => $request->query('orderId'),
            'amount' => $request->query('amount'),
        ]);
    }

    public function momoNotify(Request $request)
    {
        // Có thể ghi log, lưu trạng thái đơn hàng tại đây
        return response()->json(['message' => 'IPN received'], 200);
    }
}
