import {
  Select,
  SelectTrigger,
  SelectValue,
  SelectContent,
  SelectItem,
} from "./ui/select";
import { Button } from "./ui/button";
import {
  Card,
  CardContent,
  CardDescription,
  CardFooter,
  CardHeader,
  CardTitle,
} from "./ui/card";
import { Input } from "./ui/input";
import { Label } from "./ui/label";
import { Pencil2Icon } from "@radix-ui/react-icons";
import BoxReveal from "./ui/box-reveal";
import { Link } from "react-router-dom";
import useMultistepForm from "../hooks/use-multistep-form";
import { useState } from "react";
import { FieldValues, useForm, UseFormRegister } from "react-hook-form";
import { PatientFormData } from "../interfaces/patient-interfaces";

function FirstStep({ register }: { register: UseFormRegister<FieldValues> }) {
  return (
    <section className="grid grid-cols-2 gap-x-8 w-full">
      <div>
        <Label>First Name</Label>
        <Input type="text" required {...register("firstName")} />
      </div>
      <div>
        <Label>Middle Name</Label>
        <Input type="text" required {...register("middleName")} />
      </div>
      <div>
        <Label>Last Name</Label>
        <Input type="text" required {...register("lastName")} />
      </div>
      <div>
        <Label>Address</Label>
        <Input type="text" required {...register("address")} />
      </div>
    </section>
  );
}

function SecondStep({ register }: { register: UseFormRegister<FieldValues> }) {
  return (
    <section className="grid">
      <div className="grid gap-4">
        <div className="flex w-full gap-4">
          <div>
            <Label>Date of Birth</Label>
            <Input type="date" required {...register("birthDate")} />
          </div>
          <div>
            <Label>Phone Number</Label>
            <Input type="number" required {...register("phoneNumber")} />
          </div>
          <div>
            <Label>Emergency Contact</Label>
            <Input type="number" required {...register("emergencyContact")} />
          </div>
        </div>

        <div className="grid w-full">
          <div>
            <Label>Insurance Provider</Label>
            <Input type="text" {...register("insuranceProvider")} />
          </div>
          <div>
            <Label>Policy Number</Label>
            <Input type="number" {...register("policyNumber")} />
          </div>
          <div>
            <Label>Gender</Label>
            <Select {...register("gender")}>
              <SelectTrigger className="w-[180px]">
                <SelectValue placeholder="Gender" />
              </SelectTrigger>
              <SelectContent>
                <SelectItem value="male">Male</SelectItem>
                <SelectItem value="female">Female</SelectItem>
                <SelectItem value="other">Other</SelectItem>
              </SelectContent>
            </Select>
          </div>
        </div>
      </div>
    </section>
  );
}

function LastStep({ register }: { register: UseFormRegister<FieldValues> }) {
  return (
    <section className="w-full">
      <div>
        <Label>Email Address</Label>
        <Input type="email" required {...register("email")} />
      </div>
      <div className="w-full">
        <Label>Password</Label>
        <Input type="password" required {...register("password")} />
      </div>
      <div className="w-full">
        <Label>Confirm Password</Label>
        <Input type="password" required {...register("confirmPassword")} />
      </div>
    </section>
  );
}

const initialData: PatientFormData = {
  firstName: "",
  middleName: "",
  lastName: "",
  gender: undefined,
  email: "",
  birthDate: "",
  address: "",
  phoneNumber: 0,
  photo: null,
  emergencyContact: 0,
  insuranceProvider: "",
  policyNumber: 0,
  password: "",
  confirmPassword: "",
};

function RegistrationForm() {
  const [data, setData] = useState<PatientFormData>(initialData);
  const { register, handleSubmit } = useForm();

  const { next, prev, currentStep, isLast, isFirst } = useMultistepForm([
    <FirstStep register={register} />,
    <SecondStep register={register} />,
    <LastStep register={register} />,
  ]);

  const onSubmit = (data: FieldValues) => {
    setData((prev) => ({ ...prev, ...data }));
    console.log(data);

    if (isLast) {
    } else {
      next();
    }
  };

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
              {!isFirst && (
                <Button onClick={prev} type="button" variant={"secondary"}>
                  Back
                </Button>
              )}
              {!isLast && <Button type="submit">Next</Button>}
              {isLast && <Button type="submit">Register</Button>}
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
