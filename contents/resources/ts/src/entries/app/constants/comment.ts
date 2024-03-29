import { UserType } from './user';
import { ReactionKeyType } from './reactions';

export type ReplyType = {
  user: UserType;
  text: string;
  replyId: number;
};

export type CommentType = {
  id: number;
  text: string;
  createdAt: string;
  user: UserType;
  nominees: UserType[];
  reactions: {
    [name in ReactionKeyType]: number;
  };
  replies: ReplyType[];
  images: string[];
};
