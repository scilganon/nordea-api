<?php


namespace Profit\Nordea\API;


use JsonRPC\Client;
use Profit\Nordea\API\SoapTypes\DownloadFileListRequest;
use Profit\Nordea\API\SoapTypes\DownloadFileListResponse;
use Profit\Nordea\API\SoapTypes\DownloadFileRequest;
use Profit\Nordea\API\SoapTypes\DownloadFileResponse;
use Profit\Nordea\API\SoapTypes\GetUserInfoRequest;
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
    public function __construct(array $config = [], string $clientUrl = 'http://0.0.0.0:8999')
    {
        $this->config = $config;
        $this->client = new Client($clientUrl);
    }

    public function getUserInfo(GetUserInfoRequest $request)
    {
        return $this->client->execute('get_user_info', [
            'config' => $this->config,
            'header' => $request->getRequestHeader(),
            'request' => $request,
        ]);
    }

    /**
     * @param DownloadFileRequest $request
     * @return DownloadFileResponse
     */
    public function downloadFile(DownloadFileRequest $request)
    {
        return $this->client->execute('download_file', [
            'config' => $this->config,
            'header' => $request->getRequestHeader(),
            'request' => $request,
        ]);
    }

    /**
     * @param DownloadFileListRequest $request
     * @return DownloadFileListResponse
     */
    public function downloadFileList(DownloadFileListRequest $request)
    {
        return $this->client->execute('download_file_list', [
            'config' => $this->config,
            'header' => $request->getRequestHeader(),
            'request' => $request,
        ]);
    }

    /**
     * @param UploadFileRequest $request
     * @return UploadFileResponse
     */
    public function uploadFile(UploadFileRequest $request)
    {
        return $this->client->execute('uploadFile', [
            'config' => $this->config,
            'header' => $request->getRequestHeader(),
            'request' => $request,
        ]);
    }
}