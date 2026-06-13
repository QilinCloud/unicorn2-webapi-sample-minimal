<?php
declare(strict_types=1);

/**
 * Creates the OTTO-backed minimal sample client.
 *
 * @return ApiWebOttoClient Client configured through config.php and environment variables.
 */
function apiWebMinimalOttoClient(): ApiWebOttoClient
{
    return new ApiWebOttoClient();
}

/**
 * Validates OTTO credentials for the minimal ApiWeb sample.
 *
 * @param Result $result Result that receives the validation response.
 * @param Request|null $request Parsed ApiWeb request.
 * @return void
 */
function validateCredentials(Result $result, ?Request $request = null): void
{
    try {
        $result->Item = apiWebMinimalOttoClient()->validateCredentials();
    } catch (Throwable $exception) {
        $result->Item = (object)array(
            'Valid' => false,
            'Message' => 'OTTO credential validation failed: ' . $exception->getMessage()
        );
    }
}

/**
 * Returns the reduced OTTO-backed capability set implemented by the minimal sample.
 *
 * @param Result $result Result that receives the capabilities DTO.
 * @param Request|null $request Parsed ApiWeb request.
 * @return void
 */
function getCapabilities(Result $result, ?Request $request = null): void
{
    ApiWebOttoClient::guard($result, function () {
        return apiWebMinimalOttoClient()->capabilities(true);
    });
}

/**
 * Downloads OTTO orders and maps them to Unicorn order DTOs.
 *
 * @param Result $result Result that receives order collection entries.
 * @param Request|null $request Parsed ApiWeb request.
 * @return void
 */
function getOrders(Result $result, ?Request $request = null): void
{
    ApiWebOttoClient::guard($result, function () use ($request) {
        return apiWebMinimalOttoClient()->getOrders($request);
    });
}

/**
 * Sends OTTO shipment information.
 *
 * @param Result $result Result that receives success state.
 * @param Request|null $request Parsed ApiWeb request.
 * @return void
 */
function setOrderSend(Result $result, ?Request $request = null): void
{
    ApiWebOttoClient::guard($result, function () use ($result) {
        return apiWebMinimalOttoClient()->setOrderSend($result->Item);
    });
}

/**
 * Updates OTTO stock through availability quantities.
 *
 * @param Result $result Result that receives success state.
 * @param Request|null $request Parsed ApiWeb request.
 * @return void
 */
function setStock(Result $result, ?Request $request = null): void
{
    ApiWebOttoClient::guard($result, function () use ($result) {
        return apiWebMinimalOttoClient()->setStock($result->Item);
    });
}

/**
 * Updates OTTO price data.
 *
 * @param Result $result Result that receives success state.
 * @param Request|null $request Parsed ApiWeb request.
 * @return void
 */
function setPrice(Result $result, ?Request $request = null): void
{
    ApiWebOttoClient::guard($result, function () use ($result) {
        return apiWebMinimalOttoClient()->setPrice($result->Item);
    });
}

/**
 * Updates OTTO processing time and delivery information.
 *
 * @param Result $result Result that receives success state.
 * @param Request|null $request Parsed ApiWeb request.
 * @return void
 */
function setProcessingTime(Result $result, ?Request $request = null): void
{
    ApiWebOttoClient::guard($result, function () use ($result) {
        return apiWebMinimalOttoClient()->setProcessingTime($result->Item);
    });
}
