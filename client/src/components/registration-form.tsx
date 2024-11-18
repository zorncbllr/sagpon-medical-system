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

function RegistrationForm() {
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

        <CardContent className="grid gap-6">
          <BoxReveal duration={0.6} width="100%">
            <section className="grid grid-cols-2 gap-x-8">
              <div>
                <Label>Full Name</Label>
                <Input type="text" required />
              </div>
              <div>
                <Label>Email Address</Label>
                <Input type="email" required />
              </div>
              <div>
                <Label>Address</Label>
                <Input type="text" required />
              </div>
              <div>
                <Label>Phone Number</Label>
                <Input type="number" required />
              </div>
              <div>
                <Label>Date of Birth</Label>
                <Input type="date" />
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
            </section>
          </BoxReveal>
          <BoxReveal width="100%" duration={0.8}>
            <section>
              <div>
                <Label>Password</Label>
                <Input type="password" required />
              </div>
              <div>
                <Label>Confirm Password</Label>
                <Input type="password" required />
              </div>
            </section>
          </BoxReveal>
        </CardContent>

        <BoxReveal duration={0.6}>
          <CardFooter className="flex gap-4">
            <Button type="submit">Register</Button>
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
