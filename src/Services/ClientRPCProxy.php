<?php


namespace Profit\Nordea\API\Services;


use JsonRPC\Client;
use Phpro\SoapClient\Type\ResultInterface;
use Profit\Nordea\API\Config;
use Profit\Nordea\API\SoapTypes\DownloadFileListRequest;
use Profit\Nordea\API\SoapTypes\DownloadFileListResponse;
use Profit\Nordea\API\SoapTypes\DownloadFileRequest;
use Profit\Nordea\API\SoapTypes\DownloadFileResponse;
use Profit\Nordea\API\SoapTypes\GetUserInfoRequest;
use Profit\Nordea\API\SoapTypes\GetUserInfoResponse;
use Profit\Nordea\API\SoapTypes\UploadFileRequest;
use Profit\Nordea\API\SoapTypes\UploadFileResponse;

class ClientRPCProxy implements ClientInterface
{
    /**
     * @var array
     */
    private $config;
    private $client;

    /**
     * ClientRPC constructor.
     */
    public function __construct(Config $config, string $clientUrl = 'http://0.0.0.0:8099')
    {
        $this->config = $config;
        $this->client = new Client($clientUrl);
    }

    public function getUserInfo(GetUserInfoRequest $request)
    {
        $rawResponse = $this->client->execute('get_user_info', [
            'config' => $this->config,
            'header' => $request->getRequestHeader(),
            'request' => $request->getRawApplicationRequest(),
        ]);

        return $this->toResponse(GetUserInfoResponse::class, $rawResponse);
    }

    /**
     * @param DownloadFileRequest $request
     * @return DownloadFileResponse
     */
    public function downloadFile(DownloadFileRequest $request)
    {
        $rawResponse = $this->client->execute('download_file', [
            'config' => $this->config,
            'header' => $request->getRequestHeader(),
            'request' => $request->getRawApplicationRequest(),
        ]);

        return $this->toResponse(DownloadFileResponse::class, json_decode($rawResponse, true));
    }

    /**
     * @param DownloadFileListRequest $request
     * @return DownloadFileListResponse
     */
    public function downloadFileList(DownloadFileListRequest $request)
    {
        $rawResponse = $this->client->execute('download_file_list', [
            'config' => $this->config,
            'header' => $request->getRequestHeader(),
            'request' => $request->getRawApplicationRequest(),
        ]);

        return $this->toResponse(DownloadFileListResponse::class, $rawResponse);
    }

    /**
     * @param UploadFileRequest $request
     * @return UploadFileResponse
     */
    public function uploadFile(UploadFileRequest $request)
    {
        $rawResponse = $this->client->execute('uploadFile', [
            'config' => $this->config,
            'header' => $request->getRequestHeader(),
            'request' => $request,
        ]);

        return $this->toResponse(UploadFileResponse::class, $rawResponse);
    }

    /**
     * @param string $targetClass
     * @param array|string $rawResponse
     * @return ResultInterface
     * @throws \Exception
     */
    protected function toResponse(string $targetClass, $rawResponse)
    {
        if(is_string($rawResponse)){
            $code = [];
            preg_match('/.*\(#(\d+)\).*/', $rawResponse, $code);

            throw new \Exception($rawResponse, $code[1]);
        }

        /** @var ResultInterface $response */
        $response = new $targetClass();
        $response->setResponseHeader($rawResponse['response_header']);
        $response->setApplicationResponse($rawResponse['application_response']);

        return $response;
    }
}