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

function FirstStep(data: FormData) {
  return (
    <BoxReveal duration={0.6} width="100%">
      <section className="grid grid-cols-2 gap-x-8">
        <div>
          <Label>First Name</Label>
          <Input type="text" required />
        </div>
        <div>
          <Label>Middle Name</Label>
          <Input type="text" required />
        </div>
        <div>
          <Label>Last Name</Label>
          <Input type="text" required />
        </div>
        <div>
          <Label>Address</Label>
          <Input type="text" required />
        </div>
      </section>
    </BoxReveal>
  );
}

function SecondStep(data: FormData) {
  return (
    <BoxReveal duration={0.6} width="100%">
      <section className="grid">
        <div className="grid gap-4">
          <div className="flex w-full gap-4">
            <div>
              <Label>Date of Birth</Label>
              <Input type="date" />
            </div>
            <div>
              <Label>Phone Number</Label>
              <Input type="0" required />
            </div>
            <div>
              <Label>Emergency Contact</Label>
              <Input type="0" required />
            </div>
          </div>

          <div className="grid w-full">
            <div>
              <Label>Insurance Provider</Label>
              <Input type="text" required />
            </div>
            <div>
              <Label>Policy Number</Label>
              <Input type="0" required />
            </div>
            <div>
              <Label>Gender</Label>
              <Select>
                <SelectTrigger className="w-[180px]">
                  <SelectValue placeholder="Gender" />
                </SelectTrigger>
                <SelectContent>
                  <SelectItem value="light">Male</SelectItem>
                  <SelectItem value="dark">Female</SelectItem>
                </SelectContent>
              </Select>
            </div>
          </div>
        </div>
      </section>
    </BoxReveal>
  );
}

function LastStep(data: FormData) {
  return (
    <BoxReveal width="100%" duration={0.8}>
      <section className="w-full">
        <div>
          <Label>Email Address</Label>
          <Input type="email" required />
        </div>
        <div className="w-full">
          <Label>Password</Label>
          <Input type="password" required />
        </div>
        <div className="w-full">
          <Label>Confirm Password</Label>
          <Input type="password" required />
        </div>
      </section>
    </BoxReveal>
  );
}

type FormData = {
  firstName: "";
  middleName: "";
  lastName: "";
  gender: "male" | "female" | "other";
  email: "";
  birthDate: Date | null;
  address: "";
  phone0: 0;
  photo: File | null;
  emergencyContact: 0;
  insuranceProvider: "";
  policy0: 0;
};

const initialData: FormData = {
  firstName: "",
  middleName: "",
  lastName: "",
  gender: "other",
  email: "",
  birthDate: null,
  address: "",
  phone0: 0,
  photo: null,
  emergencyContact: 0,
  insuranceProvider: "",
  policy0: 0,
};

function RegistrationForm() {
  const [data, setData] = useState<FormData>(initialData);
  const { next, prev, currentStep, isLast, isFirst } = useMultistepForm([
    <FirstStep {...data} />,
    <SecondStep {...data} />,
    <LastStep {...data} />,
  ]);

  return (
    <Card className="w-[40rem]">
      <form>
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
              {!isLast && (
                <Button onClick={next} type="button">
                  Next
                </Button>
              )}
              {isLast && (
                <Button onClick={next} type="submit">
                  Register
                </Button>
              )}
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
