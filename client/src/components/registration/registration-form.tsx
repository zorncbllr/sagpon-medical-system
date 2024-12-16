import { Button } from "../ui/button";
import {
  Card,
  CardContent,
  CardDescription,
  CardFooter,
  CardHeader,
  CardTitle,
} from "../ui/card";
import { Pencil2Icon } from "@radix-ui/react-icons";
import BoxReveal from "../ui/box-reveal";
import { Link } from "react-router-dom";
import useMultiFormStore from "../../store/multiform-store";
import { useEffect } from "react";
import { FirstStep, LastStep, SecondStep } from "./register-form-steps";
import { FieldValues, useForm } from "react-hook-form";
import { zodResolver } from "@hookform/resolvers/zod";
import {
  firstStepSchema,
  lastStepSchema,
  secondStepSchema,
} from "../../schemas/patient-interfaces";
import { useRegister } from "../../services/users/mutations";

function RegistrationForm() {
  const {
    currentStep,
    isFirstStep,
    setData,
    isLastStep,
    next,
    prev,
    initialize,
    data,
    currentSchema,
    setErrors,
  } = useMultiFormStore();

  const { mutate } = useRegister();

  const { register, handleSubmit, formState } = useForm({
    resolver: zodResolver(currentSchema!),
  });

  const onSubmit = (formdata: FieldValues) => {
    setData({ ...formdata });

    if (isLastStep()) {
      mutate({ ...data, ...formdata });
    } else {
      next();
    }
  };

  useEffect(() => {
    setErrors({ ...formState.errors });
    initialize({
      steps: [
        <FirstStep register={register} />,
        <SecondStep register={register} />,
        <LastStep register={register} />,
      ],
      schemas: [firstStepSchema, secondStepSchema, lastStepSchema],
    });
  }, [formState.errors]);

  return (
    <Card className="w-[40rem]">
      <form onSubmit={handleSubmit(onSubmit)}>
        <CardHeader>
          <BoxReveal width="100%" duration={0.7}>
            <CardTitle className="flex justify-between">
              <span>Register</span>
              <Pencil2Icon color="green" />
            </CardTitle>
          </BoxReveal>
          <BoxReveal duration={0.8}>
            <CardDescription>
              Please make sure to provide all fields to continue.
            </CardDescription>
          </BoxReveal>
        </CardHeader>

        <CardContent className="flex gap-6">{currentStep}</CardContent>

        <BoxReveal width="100%" duration={0.6}>
          <CardFooter className="flex gap-4 justify-between w-full">
            <div className="flex gap-4">
              {!isFirstStep() && (
                <Button
                  onClick={() => prev()}
                  type="button"
                  variant={"secondary"}
                >
                  Back
                </Button>
              )}
              {!isLastStep() && <Button type="submit">Next</Button>}
              {isLastStep() && <Button type="submit">Register</Button>}
            </div>

            <Button type="button" variant={"secondary"}>
              <Link to="/login" replace>
                Cancel
              </Link>
            </Button>
          </CardFooter>
        </BoxReveal>
      </form>
    </Card>
  );
}

export default RegistrationForm;
