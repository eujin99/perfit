// regist.js
const sendit = () => {
	// Input들을 각각 변수에 대입
    const userid = document.regiform.id;
	const userpw = document.regiform.pw;
    const userpw_ch = document.regiform.pw_ch;
    const username = document.regiform.username;
    const userage = document.regiform.userage;
    const usersex = document.regiform.usersex;
    const userheight = document.regiform.userheight;
    const userweight = document.regiform.userweight;
    const userbmi = document.regiform.userbmi;
    
    // userid값이 비어있으면 실행.
    if(userid.value == '') {
        alert('아이디를 입력해주세요.');
        userid.focus();
        return false;
    }
    // userid값이 4자 이상 12자 이하를 벗어나면 실행.
    if(userid.value.length < 4 || userid.value.length > 12){
        alert("아이디는 4자 이상 12자 이하로 입력해주세요.");
        userid.focus();
        return false;
    }
    // userpw값이 비어있으면 실행.
    if(userpw.value == '') {
        alert('비밀번호를 입력해주세요.');
        userpw.focus();
        return false;
    }
    // userpw_ch값이 비어있으면 실행.
    if(userpw_ch.value == '') {
        alert('비밀번호 확인을 입력해주세요.');
        userpw_ch.focus();
        return false;
    }
    // userpw값이 6자 이상 20자 이하를 벗어나면 실행.
    if(userpw.value.length < 6 || userpw.value.length > 20){
        alert("비밀번호는 6자 이상 20자 이하로 입력해주세요.");
        userpw.focus();
        return false;
    }
	// userpw값과 userpw_ch값이 다르면 실행.
    if(userpw.value != userpw_ch.value) {
        alert('비밀번호가 다릅니다. 다시 입력해주세요.');
        userpw_ch.focus();
        return false;
    }
    // username값이 비어있으면 실행.
    if(username.value == '') {
        alert('이름을 입력해주세요.');
        username.focus();
        return false;
    }
    // 한글 이름 형식 정규식
    const expNameText = /[가-힣]+$/;
    // username값이 정규식에 부합한지 체크
    if(!expNameText.test(username.value)){
        alert("이름 형식이 맞지않습니다. 형식에 맞게 입력해주세요.");
        username.focus();
        return false;
    }
    // userage값이 비어있으면 실행.
    if(userage.value == '') {
        alert('나이를 입력해주세요.');
        userphone.focus();
        return false;
    }
    // useresex값이 비어있으면 알림창을 띄우고 input에 포커스를 맞춘 뒤 False를 리턴한다.
    if(usersex.value == '') {
        alert('성별을 입력해주세요.');
        usersex.focus();
        return false;
    }
	
    // userheight값이 비어있으면 알림창을 띄우고 input에 포커스를 맞춘 뒤 False를 리턴한다.
    if(userheight.value == '') {
        alert('키를 입력해주세요.');
        userheight.focus();
        return false;
    }
    // userweight값이 비어있으면 알림창을 띄우고 input에 포커스를 맞춘 뒤 False를 리턴한다.
    if(userweight.value == '') {
        alert('몸무게을 입력해주세요.');
        userage.focus();
        return false;
    }
    
    // userbmi값이 비어있으면 알림창을 띄우고 input에 포커스를 맞춘 뒤 False를 리턴한다.
    if(userbmi.value == '') {
        alert('bmi을 입력해주세요.');
        userbmi.focus();
        return false;
    }
    
    // //나이가 숫자로만 입력되었는지 확인
    // let ageRegex = /^(0[0-9]|1[0-9]|2[0-9]|3[0-9]|4[0-9]|5[0-9]|6[0-9]|7[0-9]|8[0-9]|9[0-9])$/;
    // if (!ageRegex.test(userage)) {
    //   alert("올바른 나이를 입력해주세요.");
    //   userage.focus();
    //   return false;
    // }
    
    
    
//     // 몸무게가 숫자로만 입력되었는지 확인
//     let heightRegex = /^[0-9]*$/;
//     if(!heightRegex.test(userheight)){
//     alert("키는 숫자만 입력해주세요");
//     return false;
//     }

//     //몸무게가 숫자로만 입력되었는지 확인
//     let wieghtRegex = /^[0-9]*$/;
//     if(!wieghtRegex.test(userweight)){
//         alert("몸무게는 숫자만 입력해주세요");
//         return false;
//     }

//     //bmi가 숫자로만 입력되었는지 확인
//     let bmiRegex = /^[0-9]*$/;
//     if(!bmiRegex.test(userbmi)){
//         alert("bmi은 숫자만 입력해주세요");
//         return false;
//    }
   

    // bmi 형식 정규식
    const expbmi = /[0-9]+[0-9]/;
    // userbmi값이 정규식에 부합한지 체크
    if(!expbmi.test(userbmi.value)) {
        alert('올바른 bmi값을 입력해주세요.');
        userbmi.focus();
        return false;
    }

    
	// 유효성 검사 정상 통과 시 true 리턴 후 form 제출.
    return true;
}