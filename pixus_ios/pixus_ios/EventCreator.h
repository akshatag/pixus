//
//  EventCreator.h
//  pixus_ios
//
//  Created by Ross Mechanic on 1/11/15.
//  Copyright (c) 2015 Akshat Agrawal. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface EventCreator : UIViewController

@property (strong, nonatomic) IBOutlet UITextField *eventName;
@property (strong, nonatomic) IBOutlet UITextField *eventDetails;
@property (strong, nonatomic) IBOutlet UITextField *eventPlace;
@property (strong, nonatomic) IBOutlet UIDatePicker *datePicker;
@property (strong, nonatomic) IBOutlet UIImageView *eventImage;
@property (strong, nonatomic) IBOutlet UIButton *addPhotoButton;
@property (strong, nonatomic) IBOutlet UIButton *cancel;
@property (strong, nonatomic) IBOutlet UIButton *create;

@end
