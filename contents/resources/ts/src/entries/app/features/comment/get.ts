import { CommentType } from '../../constants/comment';
import { api } from '../../../../common/utils/api';

type GetCommentsAPIType = (page?: number) => Promise<CommentType[]>;
export const getCommentsAPI: GetCommentsAPIType = (page = 1) => api<CommentType[]>(`/comment?page=${page}`, 'GET');

type FindCommentAPIType = (commentId: number) => Promise<CommentType>;
export const findCommentAPI: FindCommentAPIType = (commentId) => api<CommentType>(`/comment/${commentId}`, 'GET');
