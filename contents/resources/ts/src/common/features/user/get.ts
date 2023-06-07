import { fetch } from '../../utils/api';

export type UserType = { id: number; name: string; icon: string };
type GetUserListApiType = () => Promise<UserType[]>;
export const getUserListApi: GetUserListApiType = () => fetch<UserType[]>('/user/list', 'GET');
