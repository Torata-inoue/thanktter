import React from "react";
import {FieldValues, SubmitHandler, useFormContext} from "react-hook-form";

type FormProps<T extends FieldValues> = {children: React.ReactNode; onSubmit: SubmitHandler<T>};
export const Form = <T extends FieldValues>({children, onSubmit}: FormProps<T>) => {
  const {handleSubmit} = useFormContext<T>();

  return (
    // eslint-disable-next-line @typescript-eslint/no-misused-promises
    <form onSubmit={handleSubmit(onSubmit)}>
      {children}
    </form>
  )
}
