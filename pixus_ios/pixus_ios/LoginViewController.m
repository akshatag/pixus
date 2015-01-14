//
//  LoginViewController.m
//  pixus_ios
//
//  Created by Ross Mechanic on 1/13/15.
//  Copyright (c) 2015 Akshat Agrawal. All rights reserved.
//

#import "LoginViewController.h"

@interface LoginViewController ()

@end

@implementation LoginViewController

- (void)viewDidLoad {
    [super viewDidLoad];
    // Do any additional setup after loading the view.
}

- (void)didReceiveMemoryWarning {
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

- (IBAction)login:(id)sender {
    // For now I just have it set so that if the text in the
    // username field says attendee, the screen will change
    // to the attendee screen, and if the username text field says host the screen will change to the host screen.
    if ([self.usernameField.text isEqualToString:@"host"]){
        [self performSegueWithIdentifier:@"HostSegue" sender:self];
    }
    if ([self.usernameField.text isEqualToString: @"attendee"]){
        [self performSegueWithIdentifier:@"AttendeeSegue" sender:self];
    }

}

/*
#pragma mark - Navigation

// In a storyboard-based application, you will often want to do a little preparation before navigation
- (void)prepareForSegue:(UIStoryboardSegue *)segue sender:(id)sender {
    // Get the new view controller using [segue destinationViewController].
    // Pass the selected object to the new view controller.
}
*/

@end
