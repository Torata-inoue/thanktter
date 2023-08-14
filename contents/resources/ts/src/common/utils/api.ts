import axios, { AxiosError, AxiosRequestConfig, AxiosResponse } from 'axios';
import { getViteEnv } from './getViteEnv';

/**
 * サーバーサイド側で例外が投げられたときに投げるエラー
 * api以外のメソッドでは使わない
 */
class ApplicationError extends Error {
  errorCode: number;

  constructor(message: string, errorCode: number) {
    super(message);
    this.name = 'ApplicationError';
    this.errorCode = errorCode;

    Object.setPrototypeOf(this, ApplicationError.prototype);
  }
}

/**
 * @typescript-eslint/no-floating-promisesを回避するためのメソッド。
 */
type HandleApiErrorType = (error: unknown) => void;
const handleApiError: HandleApiErrorType = (error) => {
  let message: string;
  if (!(error instanceof ApplicationError)) {
    // TODO サーバーサイドへログを投げる
    message = '通信エラー';
    console.log(error);
  } else {
    message = error.message;
  }
  // eslint-disable-next-line no-alert
  alert(message);
};

type ResponseData<T> = {
  data: T;
  error?: {
    status: number;
    message: string;
  };
};
type AxiosErrorDataType = {
  message: string;
};
async function api<T>(path: string, method: 'GET' | 'POST', data?: any, config?: AxiosRequestConfig): Promise<T> {
  let response: AxiosResponse<ResponseData<T>>;

  try {
    if (method === 'GET') {
      // eslint-disable-next-line @typescript-eslint/no-unsafe-argument
      response = await axios.get(`${getViteEnv('endpoint')}${path}`, config);
    } else {
      response = await axios.post(`${getViteEnv('endpoint')}${path}`, data, config);
    }
  } catch (error) {
    if (error instanceof AxiosError<AxiosErrorDataType, unknown>) {
      // eslint-disable-next-line @typescript-eslint/no-unsafe-member-access,@typescript-eslint/no-unsafe-assignment
      const message: string = error.response ? error.response.data.message : '通信エラー';
      throw new ApplicationError(message, error.status as number);
    }

    throw error;
  }

  if (response.data.error) {
    const { message, status } = response.data.error;
    throw new ApplicationError(message, status);
  }

  return response.data.data;
}

export { api, ApplicationError, handleApiError };
