<?php


namespace Profit\Nordea\API;


use Profit\Nordea\API\SoapTypes\DownloadFileListRequest;
use Profit\Nordea\API\SoapTypes\DownloadFileListResponse;
use Profit\Nordea\API\SoapTypes\DownloadFileRequest;
use Profit\Nordea\API\SoapTypes\DownloadFileResponse;
use Profit\Nordea\API\SoapTypes\GetUserInfoRequest;
use Profit\Nordea\API\SoapTypes\GetUserInfoResponse;
use Profit\Nordea\API\SoapTypes\UploadFileRequest;
use Profit\Nordea\API\SoapTypes\UploadFileResponse;

interface ClientInterface
{
    /**
     * @param GetUserInfoRequest $request
     * @return GetUserInfoResponse
     */
    public function getUserInfo(GetUserInfoRequest $request);

    /**
     * @param DownloadFileRequest $request
     * @return DownloadFileResponse
     */
    public function downloadFile(DownloadFileRequest $request);

    /**
     * @param DownloadFileListRequest $request
     * @return DownloadFileListResponse
     */
    public function downloadFileList(DownloadFileListRequest $request);

    /**
     * @param UploadFileRequest $request
     * @return UploadFileResponse
     */
    public function uploadFile(UploadFileRequest $request);
}