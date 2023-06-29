import { UserType } from './user';
import { ReactionNameType } from './reactions';

type ReplyType = {
  user: UserType;
  text: string;
};

export type CommentType = {
  id: number;
  text: string;
  createdAt: string;
  user: UserType;
  nominees: UserType[];
  reactions: {
    [name in ReactionNameType]: number;
  };
  replies: ReplyType[];
};
