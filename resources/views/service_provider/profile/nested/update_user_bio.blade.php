@extends('layouts.service_provider_master')
@section('content')
<div class="container ">
   <div class="row  justify-content-center" >
      <div class="col-lg-12 shadow-sm sticky-top bg-white p-3 border-d">
         <div class="row">
            <div class="col-3">
               <a href="{{route('service_provider_profile_nested')}}" onclick="toggle_animation(true);"><i class="fas fa-arrow-left theme-color fs-1" ></i> </a>
            </div>
            <div class="col-6 font-size-bolder text-center font-weight-bold theme-color">
                About You
            </div>
            <div class="col-3 text-right">
                <a href="{{route('service_provider_profile_nested')}}" class="theme-color font-weight-bold" onclick="toggle_animation(true);">Next</a>
            </div>
         </div>
      </div>
      <div class="col-lg-12 p-3">
            <div class="alert alert-info  fs--1">
                When you sign up as a Service Provider remember to tell us a little bit about yourself in the ‘About Me’ section.
                This information can include your qualifications and anything that you think will help a Service Seeker to select you.
                <br>
                Please do not disclose personal information, e.g., Phone Number, Email, Full Name or Banking details.
            </div>
           
            @if(Session::has('status'))
            <div class="alert alert-success fs--1">{{Session::pull('status')}}</div>
            @endif
            <form id="aboutMeForm" action="{{route('service_provider_profile_update_user_bio')}}" files="false" method="post" enctype="multipart/form-data" >
                {{csrf_field()}}
                <div class="form-group">
                    <textarea class="form-control" type="text" name="user_bio" id="about_me_input" placeholder="Tell us about you...." rows="10">{{Auth::user()->user_bio}}</textarea>
                    <span class="text-danger fs--2 d-none" id="msg-alert">You message contains keywords that violates our privacy policy.</span>
                </div>
                <p class="fs--2">
                    Max character 2000. <span id="total_char_count"></span>
                </p>
            </form>
            <button class="btn btn-sm theme-background-color card-1 border-0" onclick="validate_reg();" id="about_me_submit">Submit</button>
        </div>
   </div>
</div>
<script>
    var user_id = "{{Auth::id()}}";
    function validate_reg(){
        //filter_text();
        var a = is_input_valid();
        console.log(a);
        if(!a) {
            if($('#aboutMeForm')[0].checkValidity()){
                toggle_animation(true, "Updating your account..");
                document.getElementById('aboutMeForm').submit();      
            }
            else {
                toggle_animation(false);      
            }
        } else {
            if($('#aboutMeForm')[0].checkValidity()){
                toggle_animation(true, "Updating your account..");
                document.getElementById('aboutMeForm').submit();      
            }
            else {
                toggle_animation(false);      
            }
            //report to admin 
            var input = $("#about_me_input").val();
            if(input != '') {
                report_policy_breach(user_id, null, input);
                console.log('Report it to admin.');
            }
        }   
    }
   
   $(document).ready(function(){
       $('#about_me_submit').attr('disabled',true);
   });
   
    $('#about_me_input').keyup(function(){
        if($(this).val().length < 4 || $(this).val().length >2000 )
            $('#about_me_submit').attr('disabled', true);
        else
            $('#about_me_submit').attr('disabled',false);
            countCharater();
    });

   function countCharater(){
       let a = $("#about_me_input").val().length.toString();
        $('#total_char_count').html('Current Count: ' + a);
   }


   function report_policy_breach(a,b,c){    
    $.ajax({
        type: "POST",
        url: app_url + '/policybreach/message/report',
        data: {
            "_token": csrf_token,
            "conversation_id": b,
            "user_id": a,
            "message": c,
            "source" : 'BIO',
        },
        success: function(results) {
            console.log(results);
        },
        error: function(results, status, err) {
            console.log(err);
        }
    });
    }

//new code to validate user message inputs
function filter_text(){
    var result = is_input_valid()
    if(result){
      //$("#service_provider_conversation_message").val("");
      $("#about_me_input").addClass('is-invalid');
      $("#about_me_input").removeClass('is-valid');
      $("#msg-alert").removeClass('d-none');
      //alert("Not allowed!");
    } else {
        $("#about_me_input").removeClass('is-invalid');
        $("#about_me_input").addClass('is-valid');
        $("#msg-alert").addClass('d-none');
    }
  }
  
  function is_input_valid(){
    var isValid = false;
    var input = $("#about_me_input").val();
    
    // array of bad/filter words
    var allBadWords = '4r5e, 5h1t, 5hit, a55, anal, cash, anus, ar5e, arrse, arse, ass, ass-fucker, asses, assfucker, assfukka, asshole, assholes, asswhole, a_s_s, b!tch, b00bs, b17ch, b1tch, ballbag, balls, ballsack, bastard, beastial, beastiality, bellend, bestial, bestiality, bi+ch, biatch, bitch, bitcher, bitchers, bitches, bitchin, bitching, bloody, blow job, blowjob, blowjobs, boiolas, bollock, bollok, boner, boob, boobs, booobs, boooobs, booooobs, booooooobs, breasts, buceta, bugger, bum, bunny fucker, butt, butthole, buttmuch, buttplug, c0ck, c0cksucker, carpet muncher, cawk, chink, cipa, cl1t, clit, clitoris, clits, cnut, cock, cock-sucker, cockface, cockhead, cockmunch, cockmuncher, cocks, cocksuck, cocksucked, cocksucker, cocksucking, cocksucks, cocksuka, cocksukka, cok, cokmuncher, coksucka, coon, cox, crap, cum, cummer, cumming, cums, cumshot, cunilingus, cunillingus, cunnilingus, cunt, cuntlick, cuntlicker, cuntlicking, cunts, cyalis, cyberfuc, cyberfuck, cyberfucked, cyberfucker, cyberfuckers, cyberfucking, d1ck, damn, dick, dickhead, dildo, dildos, dink, dinks, dirsa, dlck, dog-fucker, doggin, dogging, donkeyribber, doosh, duche, dyke, ejaculate, ejaculated, ejaculates, ejaculating, ejaculatings, ejaculation, ejakulate, f u c k, f u c k e r, f4nny, fag, fagging, faggitt, faggot, faggs, fagot, fagots, fags, fanny, fannyflaps, fannyfucker, fanyy, fatass, fcuk, fcuker, fcuking, feck, fecker, felching, fellate, fellatio, fingerfuck, fingerfucked, fingerfucker, fingerfuckers, fingerfucking, fingerfucks, fistfuck, fistfucked, fistfucker, fistfuckers, fistfucking, fistfuckings, fistfucks, flange, fook, fooker, fuck, fucka, fucked, fucker, fuckers, fuckhead, fuckheads, fuckin, fucking, fuckings, fuckingshitmotherfucker, fuckme, fucks, fuckwhit, fuckwit, fudge packer, fudgepacker, fuk, fuker, fukker, fukkin, fuks, fukwhit, fukwit, fux, fux0r, f_u_c_k, gangbang, gangbanged, gangbangs, gaylord, gaysex, goatse, god-dam, god-damned, goddamn, goddamned, hardcoresex, hell, heshe, hoar, hoare, hoer, homo, hore, horniest, horny, hotsex, jack-off, jackoff, jap, jerk-off, jism, jiz, jizm, jizz, kawk, knob, knobead, knobed, knobend, knobhead, knobjocky, knobjokey, kock, kondum, kondums, kum, kummer, kumming, kums, kunilingus, l3i+ch, l3itch, labia, lmfao, lust, lusting, m0f0, m0fo, m45terbate, ma5terb8, ma5terbate, masochist, master-bate, masterb8, masterbat, masterbat3, masterbate, masterbation, masterbations, masturbate, mo-fo, mof0, mofo, mothafuck, mothafucka, mothafuckas, mothafuckaz, mothafucked, mothafucker, mothafuckers, mothafuckin, mothafucking, mothafuckings, mothafucks, mother fucker, motherfuck, motherfucked, motherfucker, motherfuckers, motherfuckin, motherfucking, motherfuckings, motherfuckka, motherfucks, muff, mutha, muthafecker, muthafuckker, muther, mutherfucker, n1gga, n1gger, nazi, nigg3r, nigg4h, nigga, niggah, niggas, niggaz, nigger, niggers, nob, nob jokey, nobhead, nobjocky, nobjokey, numbnuts, nutsack, orgasim, orgasims, orgasm, orgasms, p0rn, pawn, pecker, penis, penisfucker, phonesex, phuck, phuk, phuked, phuking, phukked, phukking, phuks, phuq, pigfucker, pimpis, piss, pissed, pisser, pissers, pisses, pissflaps, pissin, pissing, pissoff, poop, porn, porno, pornography, pornos, prick, pricks, pron, pube, pusse, pussi, pussies, pussy, pussys, rectum, retard, rimjaw, rimming, s hit, s.o.b., sadist, schlong, screwing, scroat, scrote, scrotum, semen, sex, sh!+, sh!t, sh1t, shag, shagger, shaggin, shagging, shemale, shi+, shit, shitdick, shite, shited, shitey, shitfuck, shitfull, shithead, shiting, shitings, shits, shitted, shitter, shitters, shitting, shittings, shitty, skank, slut, sluts, smegma, smut, snatch, son-of-a-bitch, spac, spunk, s_h_i_t, t1tt1e5, t1tties, teets, teez, testical, testicle, tit, titfuck, tits, titt, tittie5, tittiefucker, titties, tittyfuck, tittywank, titwank, tosser, turd, tw4t, twat, twathead, twatty, twunt, twunter, v14gra, v1gra, vagina, viagra, vulva, w00se, wang, wank, wanker, wanky, whoar, whore, willies, willy, xrated, xxx, arsehole, assbag, assbandit, assbanger, assbite, assclown, asscock, asscracker, assface, assfuck, assgoblin, asshat, ass-hat, asshead, asshopper, ass-jabber, assjacker, asslick, asslicker, assmonkey, assmunch, assmuncher, assnigger, asspirate, ass-pirate, assshit, assshole, asssucker, asswad, asswipe, axwound, bampot, beaner, bitchass, bitchtits, bitchy, bollocks, bollox, brotherfucker, bullshit, bumblefuck, butt plug, buttfucka, butt-pirate, buttfucker, camel toe, carpetmuncher, chesticle, chinc, choad, chode, clitface, clitfuck, clusterfuck, cockass, cockbite, cockburger, cockfucker, cockjockey, cockknoker, cockmaster, cockmongler, cockmongruel, cockmonkey, cocknose, cocknugget, cockshit, cocksmith, cocksmoke, cocksmoker, cocksniffer, cockwaffle, coochie, coochy, cooter, cracker, cumbubble, cumdumpster, cumguzzler, cumjockey, cumslut, cumtart, cunnie, cuntass, cuntface, cunthole, cuntrag, cuntslut, dago, deggo, dickbag, dickbeaters, dickface, dickfuck, dickfucker, dickhole, dickjuice, dickmilk , dickmonger, dicks, dickslap, dick-sneeze, dicksucker, dicksucking, dicktickler, dickwad, dickweasel, dickweed, dickwod, dike, dipshit, doochbag, dookie, douche, douchebag, douche-fag, douchewaffle, dumass, dumb ass, dumbass, dumbfuck, dumbshit, dumshit, fagbag, fagfucker, faggit, faggotcock, fagtard, feltch, flamer, fuckass, fuckbag, fuckboy, fuckbrain, fuckbutt, fuckbutter, fuckersucker, fuckface, fuckhole, fucknut, fucknutt, fuckoff, fuckstick, fucktard, fucktart, fuckup, fuckwad, fuckwitt, gay, gayass, gaybob, gaydo, gayfuck, gayfuckist, gaytard, gaywad, goddamnit, gooch, gook, gringo, guido, handjob, hard on, heeb, ho, hoe, homodumbshit, honkey, humping, jackass, jagoff, jerk off, jerkass, jigaboo, jungle bunny, junglebunny, kike, kooch, kootch, kraut, kunt, kyke, lameass, lardass, lesbian, lesbo, lezzie, mcfagget, mick, minge, muffdiver, munging, negro, nigaboo, niglet, nut sack, paki, panooch, peckerhead, penisbanger, penispuffer, pissed off, polesmoker, pollock, poon, poonani, poonany, poontang, porch monkey, porchmonkey, punanny, punta, pussylicking, puto, queef, queer, queerbait, queerhole, renob, rimjob, ruski, sand nigger, sandnigger, shitass, shitbag, shitbagger, shitbrains, shitbreath, shitcanned, shitcunt, shitface, shitfaced, shithole, shithouse, shitspitter, shitstain, shittiest, shiz, shiznit, skeet, skullfuck, slutbag, smeg, spic, spick, splooge, spook, suckass, tard, thundercunt, twatlips, twats, twatwaffle, unclefucker, vag, vajayjay, va-j-j, vjayjay, wankjob, wetback, whorebag, whoreface, wop, breeder, cocklump, creampie, doublelift, dumbcunt, fuck off, incest, jack Off, poopuncher, sandler, cockeye, crotte, foah, fucktwat, jaggi, kunja, pust, sanger, seks, slag, zubb, 2g1c, 2 girls 1 cup, acrotomophilia, alabama hot pocket, alaskan pipeline, anilingus, apeshit, auto erotic, autoerotic, babeland, baby batter, baby juice, ball gag, ball gravy, ball kicking, ball licking, ball sack, ball sucking, bangbros, bareback, barely legal, barenaked, bastardo, bastinado, bbw, bdsm, beaners, beaver cleaver, beaver lips, big black, big breasts, big knockers, big tits, bimbos, birdlock, black cock, blonde action, blonde on blonde action, blow your load, blue waffle, blumpkin, bondage, booty call, brown showers, brunette action, bukkake, bulldyke, bullet vibe, bung hole, bunghole, busty, buttcheeks, camgirl, camslut, camwhore, chocolate rosebuds, circlejerk, cleveland steamer, clover clamps, coprolagnia, coprophilia, cornhole, coons, darkie, date rape, daterape, deep throat, deepthroat, dendrophilia, dingleberry, dingleberries, dirty pillows, dirty sanchez, doggie style, doggiestyle, doggy style, doggystyle, dog style, dolcett, domination, dominatrix, dommes, donkey punch, double dong, double penetration, dp action, dry hump, dvda, eat my ass, ecchi, erotic, erotism, escort, eunuch, fecal, felch, female squirting, femdom, figging, fingerbang, fingering, fisting, foot fetish, footjob, frotting, fuck buttons, fucktards, futanari, gang bang, gay sex, genitals, giant cock, girl on, girl on top, girls gone wild, goatcx, god damn, gokkun, golden shower, goodpoop, goo girl, goregasm, grope, group sex, g-spot, guro, hand job, hard core, hardcore, hentai, homoerotic, hooker, hot carl, hot chick, how to kill, how to murder, huge fat, intercourse, jail bait, jailbait, jelly donut, jiggaboo, jiggerboo, juggs, kinbaku, kinkster, kinky, knobbing, leather restraint, leather straight jacket, lemon party, lolita, lovemaking, make me come, male squirting, menage a trois, milf, missionary position, mound of venus, mr hands, muff diver, muffdiving, nambla, nawashi, neonazi, nig nog, nimphomania, nipple, nipples, nsfw images, nude, nudity, nympho, nymphomania, octopussy, omorashi, one cup two girls, one guy one jar, orgy, paedophile, panties, panty, pedobear, pedophile, pegging, phone sex, piece of shit, piss pig, pisspig, playboy, pleasure chest, pole smoker, ponyplay, poof, punany, poop chute, poopchute, prince albert piercing, pthc, pubes, queaf, quim, raghead, raging boner, rape, raping, rapist, reverse cowgirl, rosy palm, rosy palm and her 5 sisters, rusty trombone, sadism, santorum, scat, scissoring, sexo, sexy, shaved beaver, shaved pussy, shibari, shitblimp, shota, shrimping, slanteye, s&m, snowballing, sodomize, sodomy, splooge moose, spooge, spread legs, strap on, strapon, strappado, strip club, style doggy, suck, sucks, suicide girls, sultry women, swastika, swinger, tainted love, taste my, tea bagging, threesome, throating, tied up, tight white, titty, tongue in a, topless, towelhead, tranny, tribadism, tub girl, tubgirl, tushy, twink, twinkie, two girls one cup, undressing, upskirt, urethra play, urophilia, venus mound, vibrator, violet wand, vorarephilia, voyeur, wet dream, white power, wrapping men, wrinkled starfish, xx, yaoi, yellow showers, yiffy, zoophilia, fool, dumb, dotcom, .com, .net, .c0m, .cOm, bsb, account, acc';

    var arrayOfBadWords = allBadWords.split(', ');
    // var filterWords = ["fool", "dumb", "couch potato","dotcom","dotcom",".com",".net",".c0m","cOm","dotc0m","dotcOm","bsb","account","acc"];
    var filterWords = arrayOfBadWords;
    var rgx = new RegExp(filterWords.join("|"), "gi");

    // function to filter out bad words
    function wordFilter(str) {
            // input = str.replace(rgx, "");
            var tmp =  rgx.test(str);
            return tmp;
        }
  
    // calling wordFilter Function
    isValid = wordFilter(input);
    if(isValid){
      return isValid;
    }

    //   remove all special characters
    input = input.replace(/[`.~!@#%^&*()_|+\-=?;:'",<>\{\}\[\]\\\/]/gi, '');

            // remove special character in-between numbers 
            const regex = /(\d)\s+(?=\d)\s+/g;
    input = input.replace(regex, "");

            //   replace alphabetic Number(one,two etc.) to natural numbers
            input = input.replace(/zero/g,'0');
    input = input.replace(/one/g,'1');
    input = input.replace(/two/g,'2');
    input = input.replace(/three/g,'3');
    input = input.replace(/four/g,'4');
    input = input.replace(/five/g,'5');
    input = input.replace(/six/g,'6');
    input = input.replace(/seven/g,'7');
    input = input.replace(/eight/g,'8');
    input = input.replace(/nine/g,'9');

    //   replace o to 0, l to 1, i to 1
    input = input.replace(/o/gi,'0');
    input = input.replace(/l/gi,'1');
    input = input.replace(/i/gi,'1');
    isValid = wordFilter(input);
    //   replace to lowercase
    input = input.replace(/ /g,'').toLowerCase();

  

  
    //   will not allow to enter more than 6 digit
    var tmpRgx = /\d{6,100}/gi
    isValid = tmpRgx.test(input);
    if(isValid){
      return isValid
    }
    // input = input.replace(/\d{6,100}/gi,'');
  

    //   logging output
    return isValid;
  }
</script>
@endsection