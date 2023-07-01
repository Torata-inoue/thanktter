import React from 'react';
import { useFormContext } from 'react-hook-form';
import { Link as RouterLink } from 'react-router-dom';
import { Avatar, Badge, Box, IconButton, Link } from '@mui/material';
import { ThumbUpAlt } from '@mui/icons-material';
import { UserType } from '../../../../../constants/user';
import { ReactionTooltip } from '../reaction/ReactionTooltip';
import { TextDiv } from '../../../../../../../common/components/text/TextDiv';
import { ReactionFormType } from '../../../../../hooks/form/useReactionForm';
import { reactionsObject } from '../../../../../constants/reactions';
import { ReactionForm } from '../reaction/ReactionForm';

const BadgeContent: React.FC = () => (
  <ThumbUpAlt
    sx={{
      backgroundColor: reactionsObject.good.color,
      color: (theme) => theme.palette.background.paper,
      borderRadius: '50%',
    }}
    fontSize="small"
  />
);

type NomineeProps = { user: UserType; commentId: number };
const Nominee: React.FC<NomineeProps> = ({ user: { id, name, icon }, commentId }) => {
  const { setValue } = useFormContext<ReactionFormType>();

  const handleOnClick: React.MouseEventHandler<HTMLButtonElement> = () => {
    setValue('type', reactionsObject.good.type);
  };

  return (
    <Box sx={{ textAlign: 'center' }}>
      <ReactionTooltip commentId={commentId}>
        <IconButton type="submit" onClick={handleOnClick}>
          <Badge
            overlap="circular"
            anchorOrigin={{ vertical: 'bottom', horizontal: 'right' }}
            badgeContent={<BadgeContent />}
          >
            <Avatar src={icon} alt={name} />
          </Badge>
        </IconButton>
      </ReactionTooltip>
      <TextDiv textAlign="center">
        <Link underline="none" component={RouterLink} to={`/user/${id}`}>
          {name}
        </Link>
      </TextDiv>
    </Box>
  );
};

type NomineesProps = { nominees: UserType[]; commentId: number };
export const Nominees: React.FC<NomineesProps> = ({ nominees, commentId }) => (
  <Box sx={{ display: 'flex', flexWrap: 'wrap' }}>
    {nominees.map((user) => (
      <ReactionForm key={user.id} userId={user.id} commentId={commentId}>
        <Nominee user={user} commentId={commentId} />
      </ReactionForm>
    ))}
  </Box>
);
