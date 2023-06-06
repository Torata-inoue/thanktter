import axios, { AxiosError, AxiosRequestConfig, AxiosResponse } from 'axios';
import { getViteEnv } from './getViteEnv';

type ResponseData<T> = {
  data: T;
  error?: {
    status: number;
    message: string;
  };
};

async function fetch<T>(path: string, method: 'GET' | 'POST', config?: AxiosRequestConfig): Promise<T> {
  try {
    let response: AxiosResponse<ResponseData<T>>;
    if (method === 'GET') {
      response = await axios.get(`${getViteEnv('endpoint')}${path}`, config);
    } else {
      response = await axios.post(`${getViteEnv('endpoint')}${path}`, config);
    }

    if (response.data.error) {
      throw Error(response.data.error.message);
    }
    return response.data.data;
  } catch (error) {
    if (error instanceof AxiosError) {
      throw Error(error.message);
    }
    throw Error('apiエラー');
  }
}

export { fetch };
