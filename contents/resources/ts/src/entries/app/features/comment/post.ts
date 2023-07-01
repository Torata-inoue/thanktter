import { api } from '../../../../common/utils/api';
import { CommentFormType } from '../../hooks/form/useCommentForm';
import { CommentType } from '../../constants/comment';
import { ReplyFormType } from '../../hooks/form/useReplyForm';

type PostCommentApiType = (data: CommentFormType) => Promise<CommentType[]>;
export const postCommentApi: PostCommentApiType = (data) =>
  api('/comment', 'POST', {
    data,
  });

type PostReplyApiType = (data: ReplyFormType) => Promise<CommentType>;
export const postReplyApi: PostReplyApiType = (data) =>
  api('/reply', 'POST', {
    data,
  });
